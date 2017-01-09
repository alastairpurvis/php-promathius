#!/usr/bin/python2.4
#
# Copyright 2009 Google Inc. All Rights Reserved.

"""Install script for the Google Checkout osCommerce module.

"""

__author__ = 'alek.dembowski@gmail.com (Alek Dembowski)'

import filecmp
import glob
import logging
import optparse
import os
import ScrolledText
import shutil
import StringIO
import subprocess
import sys
import tempfile
import Tkinter
import tkFileDialog
import tkMessageBox
import zipfile

MERGE_MARKER = '<<<<<<<'

MANUAL_DOCS = 'http://code.google.com/p/google-checkout-oscommerce/wiki/Documentation'

class WizardBuilder(object):
  def __init__(self, diff3, *args, **kwargs):
    super(WizardBuilder, self).__init__(*args, **kwargs)

    self.diff3 = diff3
    self.row = 0
    self.window = Tkinter.Tk()
    self.window.title('Google Checkout Module Deployer')

    self.welcome_screen = self.build_config_screen(self.window)

    self.welcome_screen.pack()

  def show_error_window(self, error_text):
    window = Tkinter.Toplevel()
    window.title('Errors')

    label = Tkinter.Label(window,
                 text='Unable to deploy the Google Checkout Module for '
                 'osCommerce due to errors in the files below.\nPlease '
                 'see %s for instructions on how to deploy the module '
                 'manually.' % MANUAL_DOCS)
    label.pack(side=Tkinter.TOP)

    text = ScrolledText.ScrolledText(window)
    text.insert('1.0', error_text)
    text.pack(side=Tkinter.BOTTOM, fill=Tkinter.BOTH, expand=1)

  def build_config_screen(self, window):
    screen = Tkinter.Frame(window)
    screen.grid_columnconfigure(1, minsize=200, weight=100)

    self.add_row(screen, 0,
                 'Welcome to the Google Checkout module deployer for osCommerce!')
    self.add_row(screen, 1,
                 'This works with osCommerce version 2.2rc2a and will\n'
                 'prepare your osCommerce store for Google Checkout.')

    self.module_entry = self.add_directory_row(screen, 2, 'Module Directory',
                                               os.getcwd())
    self.install_entry = self.add_directory_row(screen, 3, 'osCommerce Directory')

    self.add_button(screen, 4, 2, 'Deploy', self.confirm)
    self.add_button(screen, 4, 3, 'Cancel', sys.exit)
    screen.pack(fill=Tkinter.BOTH, expand=1)

    return screen

  def add_row(self, frame, row, text):
    label = Tkinter.Label(frame, text=text)
    label.grid(row=row, column=0, columnspan=4, pady=5)

  def add_directory_row(self, frame, row, label_text, default=''):
    label = Tkinter.Label(frame, text=label_text)
    label.grid(row=row, column=0, sticky=Tkinter.W, padx=5, pady=5)

    entry = Tkinter.Entry(frame)
    entry.config(bg='white')
    entry.insert(Tkinter.END, default)
    entry.grid(row=row, column=1, columnspan=2, sticky=Tkinter.W + Tkinter.E)

    def update():
      entry.delete(0, Tkinter.END)
      entry.insert(Tkinter.END, tkFileDialog.askdirectory())

    self.add_button(frame, row, 3, 'Browse', update)
    return entry

  def add_button(self, frame, row, column, text, command):
    button = Tkinter.Button(frame, text=text, command=command)
    button.grid(row=row, column=column, sticky=Tkinter.E, padx=5, pady=3)
    return button

  def confirm(self):
    if not self.module_entry.get().strip():
      return tkMessageBox.showerror(title='Unable to find directory',
          message='Please enter where you downloaded the '
                  'Google Checkout module.')
    elif not self.install_entry.get().strip():
      return tkMessageBox.showerror(title='Unable to find directory',
          message='Please enter where you installed osCommerce.')

    backup_dir = tempfile.mkdtemp(prefix='checkout-osc-module')
    logging.info('Backup dir %s' % backup_dir)

    module_dir = os.path.join(self.module_entry.get(), 'catalog%s' % os.sep)
    install_dir = self.install_entry.get()
    golden_dir = os.path.join(self.module_entry.get(), 'tools', 'golden',
                              'oscommerce-2.2rc2a', 'catalog%s' % os.sep)

    if (not os.path.exists(module_dir)
        or not os.path.exists(os.path.join(module_dir, 'googlecheckout'))):
      return tkMessageBox.showerror(title='Unable to find directory',
          message='Unable to find the checkout module. Please check '
                  'the directory and try again.')
    elif (not os.path.exists(os.path.join(install_dir, 'index.php')) or
          not os.path.exists(os.path.join(install_dir, 'shopping_cart.php'))):
      return tkMessageBox.showerror(title='Unable to find directory',
          message='Unable to verify the osCommerce installation. '
                  'Please check the directory and try again.')
    elif not os.path.exists(golden_dir):
      return tkMessageBox.showerror(title='Unable to find directory',
          message='Unable to find the checkout module. Please check '
                  'the directory and try again.')

    backup(install_dir, backup_dir)
    try:
      problems = install(self.diff3, module_dir, golden_dir, install_dir)

      if problems:
        rollback(install_dir, backup_dir)

        self.show_error_window('\n\n'.join(['%s: %s' % (file, reason) for (reason, file) in problems]))
        return
    except Exception, e:
      logging.error('Exception occured: %s' % e, exc_info=e)
      rollback(install_dir, backup_dir)
      return

    shutil.rmtree(backup_dir)
    tkMessageBox.showinfo(title='Deploy Sucessful',
                          message='The Google Checkout module for osCommerce '
                            'has deployed successfully.\n'
                            'Please configure the plugin from the osCommerce'
                            ' admin interface to complete the installation.')
    sys.exit()


def install_file(diff3, module, golden, destination):
  '''Installs the module file to the destination directory.

  For each file, if it only exists in the module, or is identical to the
  install we pass, We only do the diff it it exists in all three places
  Module           Install                Result
    Changed          Same                   Merge
                     Changed                Merge
                     Deleted                Warn
    New              New                    Okay IFF contents match
                     Doesn't Exist          Copy

  Expects the path to the module's changed file, the golden file and the
  destination file.

  Straight copy if it doesn't exist in the destination, merge if it does
  exist.

  Returns True iff there are no conflicts or warnings.

  Returns None if there are no errors or a tuple with the error and file name
          there was an error with

  '''
  if os.path.isdir(module):
    return None

  if not os.path.exists(destination):
    make_dir(os.path.dirname(destination))
    shutil.copy2(module, destination)
    os.chmod(destination, 0775)

    if os.path.exists(golden):
      return ('This file has been removed from your installation and is '
              'required for the module.', destination)
  elif not os.path.exists(golden):
    # Touchy here... we should only be okay with this case if we know the files
    # are the same...
    if filecmp.cmp(module, destination):
      return None
    else:
      return ('File unexpectedly exists in the installation directory. '
              'This may mean that the module has been installed once '
              'before already.', destination)


  if filecmp.cmp(module, destination):
    # It seems we already applied the changes
    return None

  # Apply the merge to the destination file
  output = merge(diff3, module, golden, destination)

  # Open dest file and write the buffer to it
  dest = open(destination, mode='w')
  dest.write(output)
  dest.close()
  os.chmod(destination, 0775)

  # Test for merge markers
  if output.find(MERGE_MARKER) >= 0:
    return ('This file appears to have been modified and we can\'t resolve '
            'the differences' , destination)

  return None


def merge(diff3, module, golden, destination):
  merger = subprocess.Popen([diff3, '-m', module, golden, destination],
                            stdout=subprocess.PIPE, stderr=subprocess.PIPE)
  (out, error) = merger.communicate()

  return out


def remove_left(original, removed):
  if original.find(removed) >= 0:
    size = len(removed)
    return original[size:]

  return original


def list_files(root):
  files = []

  for dirpath, dirnames, filenames in os.walk(root):
    if dirpath.find('.svn') < 0:
      # Strip the root from the path so we have the relative dir
      relative_path = remove_left(dirpath, root)

      for name in filenames:
        files.append(os.path.join(relative_path, name))

  return files


def install(diff3, module, golden, install):
  module_files = list_files(module)

  # Some files in the module need to be set to be writable... this feels hacky
  # but is currently how the module is written. Should think of better ways to
  # do this going forward.
  writable_files = [
    os.path.join(install, 'googlecheckout', 'feeds', 'products-static.xml'),
    os.path.join(install, 'googlecheckout', 'feeds', 'sitemap-static.xml'),
    os.path.join(install, 'googlecheckout', 'logs', 'last_updated.log'),
    os.path.join(install, 'googlecheckout', 'logs', 'response_error.log'),
    os.path.join(install, 'googlecheckout', 'logs', 'response_message.log'),
  ]

  errors = []

  fail = False
  for file in module_files:
    try:
      if file.startswith(os.sep):
        file = file.lstrip(os.sep)

      module_file = os.path.join(module, file)
      golden_file = os.path.join(golden, file)
      installation_file = os.path.join(install, file)

      logging.info('Installing %s to %s' % (module_file, installation_file))

      error = install_file(diff3, module_file, golden_file, installation_file)

      if error:
        errors.append(error)

    except Exception, error:
      logging.error('Error while installing file: %s' % file, exc_info=error)
      errors.append(('Error occurred: %s' % error, installation_file))

  if not errors:
    for file in writable_files:
      if os.path.exists(file):
        os.chmod(file, 0777)

  return errors


def make_dir(path):
  # This really is a work around for makedirs not behaving as specified. The
  # docs say it will make all the required directories with permissions of 777,
  # but this doesn't appear to be consistently honored.
  if not os.path.exists(path):
    path = path.rstrip(os.sep)
    make_dir(os.path.dirname(path))
    os.mkdir(path)

    os.chmod(path, 0755)


def add_dir_to_zip(zip_file, directory):
  for file in glob.glob(directory + '/*'):
    if os.path.isfile(file):
      zip_file.write(file, file, zipfile.ZIP_DEFLATED)
    elif os.path.isdir(file):
      add_dir_to_zip(zip_file, file)


def backup(install_dir, backup_dir, do_zip=True):
  shutil.copytree(install_dir, os.path.join(backup_dir, 'backup'))
  
  if do_zip:
    # Zip installation in tmp directory.
    zip_file_path = os.path.join(backup_dir, 'backup.zip')
    zip_file = zipfile.ZipFile(zip_file_path, 'w')
    add_dir_to_zip(zip_file, install_dir)
    zip_file.close()
  
    # Copy zip to installation directory.
    backups_dir = os.path.join(install_dir, 'googlecheckout', 'backups')
    make_dir(backups_dir)
    shutil.copy(zip_file_path, backups_dir)


def rollback(install_dir, backup_dir):
  if (os.path.exists(os.path.join(backup_dir, 'backup'))
      and os.path.isdir(os.path.join(backup_dir, 'backup'))):
    shutil.rmtree(install_dir)
    shutil.copytree(os.path.join(backup_dir, 'backup'), install_dir)


def main():
  p = optparse.OptionParser()
  p.add_option('-q', '--quiet', action='store_true')
  p.add_option('-d', '--diff3', action='store', default='diff3',
               help='Path to the diff3 executable. Assumes diff3 '
                    'exists on the system path otherwise.')
  p.add_option('-b', '--backup', action='store',
               help='Specify a directory to store the backup in')
  p.add_option('-z', '--zip_backup', action='store_true',
               help='Create a zip of the backup and copy it into the installation')
  p.add_option('-u', '--ui', action='store_true',
               help='Runs the script using the UI wizard')
  p.add_option('-r', '--restore', action='store',
               help='Specifies the directory the backup is in')

  options, args =  p.parse_args()
  if not options.quiet:
    logging.getLogger().setLevel(logging.ERROR)
  else:
    logging.getLogger().setLevel(logging.DEBUG)
    if options.diff3:
      logging.info('Diff3 option passed: %s' % options.diff3)

  if options.restore:
    if len(args) > 1:
      logging.error('Too many arguments for restoring from a backup, expected '
                    '<installation directory>')
    elif len(args) < 1:
      logging.error('Too few arguments, expected '
                    '<installation directory>')
    else:
      rollback(args[0], args[1])
  elif options.ui:
    builder = WizardBuilder(options.diff3)
    Tkinter.mainloop()
  else:
    if len(args) < 3:
      print ('Not enough arguments supplied, expects '
             '<checkout module> <clean oscommerce> <existing oscommerce install>')
      return
    elif len(args) > 3:
      print ('Too many args provided, expects '
             '<checkout module> <clean oscommerce> <existing oscommerce install>')
      return

    print('Beginning install process')

    module_dir = args[0]
    golden_dir = args[1]
    install_dir = args[2]
    if options.backup:
      backup_dir = os.path.realpath(options.backup)

      if os.path.exists(backup_dir):
        shutil.rmtree(backup_dir)
        make_dir(os.path.dirname(backup_dir.rstrip(os.sep)))
    else:
      backup_dir = tempfile.mkdtemp(prefix='checkout-osc-module')
      logging.info('Backup dir: %s' % backup_dir)

    try:
      backup(install_dir, backup_dir, options.zip_backup)
    finally:
      if not options.backup:
        # In this case the backup was only temporary
        shutil.rmtree(backup_dir)
    install(options.diff3, module_dir, golden_dir, install_dir)


if __name__ == '__main__':
  main()
