#!/bin/bash
#
# Script for installing Google Checkout plugin for osCommerce
#
# For files we're adding, there are four files involved:
#
#  1) Source File (the file we intend to add)
#  2) Install File (the file we create in your OSC installation)
#
# In this case, we install by copying the source file to the install file.
# We uninstall by deleting the install file.
#
# For files we're *changing*, there are four files involved:
#
#  1) Source File (contains the changes we wish to make)
#  2) OSC Golden File (a clean copy of the file from OSC)
#  3) Install File (the file in your OSC installation that we will change)
#  4) Backup File (a copy of your install file before we changed it)
#
# In this case, we install by first copying the install file to the backup
# file. Then, we run a merge (merge "install" "golden" "source") to apply our 
# changes to OSC to your OSC installation. If you're running a modified copy
# of OSC, some of the merges may fail. You can then correct the merge yourself
# or uninstall. We uninstall by copying the backup file back to the install 
# file and then deleting the backup file.
#
# For usage, please run ./install.sh help
#
# Author: Ed Davisson (ed.davisson@gmail.com)
#

DEBUG=true

OSC_GOLDEN_DIR="tools/golden/oscommerce-2.2rc2a"
CATALOG="catalog"
GOOGLECHECKOUT="${CATALOG}/googlecheckout"
TMP_DIR="tmp"
BACKUP_SUFFIX="google.backup"

# These files have their permissions set to 777 at the end of the installation.
LOG_FILES=( \
    "${CATALOG}/googlecheckout/feeds/products-static.xml" \
    "${CATALOG}/googlecheckout/feeds/sitemap-static.xml" \
    "${CATALOG}/googlecheckout/logs/last_updated.log" \
    "${CATALOG}/googlecheckout/logs/response_error.log" \
    "${CATALOG}/googlecheckout/logs/response_message.log" \
    )

# Set via command line parameters.
OSC_ROOT_DIR=""

MERGE_ERROR=false
MERGE_ERROR_LIST=()

########################################
# Echoes to stdout if DEBUG is set to true.
# Arguments:
#   message Message to print.
########################################
function debug {
  local message="${1}"
  if [[ ${DEBUG} == true ]]; then
    echo -e "${message}"
  fi
}

########################################
# Echoes help message and exits.
# Arguments:
#   None.
########################################
function help {
  echo -e "Arguments: $0 {install|uninstall|reinstall|test} osc_root_directory"
  echo -e "           $0 help"
  exit 0
}

########################################
# Returns a dividing line.
# Arguments:
#   None.
# Returns:
#   A dividing line.
########################################
function line {
  echo "======================================================================="
}

########################################
# Returns the directory containing the file.
# Arguments:
#   file File for which to determine the directory.
# Returns: 
#   directory name
########################################
function get_directory {
  local file="${1}"
  echo "${file%/*}"
}

########################################
# Determines the name of the OSC golden file from the source file
# Arguments:
#   source_file Source file for which to calculate the OSC golden file.
# Returns:
#   OSC golden filename
########################################
function get_osc_golden_file {
  local source_file="${1}"
  osc_golden_file="${OSC_GOLDEN_DIR}/${source_file}"
  echo "${osc_golden_file}"
}

########################################
# Determines the name of the install file from the source file.
# Arguments:
#   source_file Source file for which to calculate the installed file name.
# Returns:
#   install filename
########################################
function get_install_file {
  local source_file="${1}"
  echo "$OSC_ROOT_DIR/$source_file"
}

########################################
# Determines the name of the backup file from the install file.
# Arguments:
#   install_file Installed file for which to determine the backup file name.
# Returns:
#   backup filename
########################################
function get_backup_file {
  local install_file="${1}"
  echo "$install_file.$BACKUP_SUFFIX"
}

########################################
# Backs up a single install file.
# Arguments:
#   install_file Installed file to back up.
########################################
function backup {
  local install_file="${1}"
  
  local backup_file
  backup_file="$(get_backup_file ${install_file})"
  
  if [[ -f "${backup_file}" ]]; then
    echo "${backup_file} already exists. Did not overwrite."
    echo "Please run uninstall before installing."
  else
    echo "Backed up ${install_file} to ${backup_file}"
    cp ${install_file} ${backup_file}
  fi
}

########################################
# If the file exists, chmod it and log an appropriate message.
# Arguments: 
#   permissions Permissions to set.
#   file File on which to change permissions.
########################################
function chmod_and_log {
  local permissions="${1}"
  local file="${2}"
  if [[ -f "${file}" ]]; then
    echo "Setting permissions on ${file} to ${permissions}"
    chmod ${permissions} ${file}
  fi
}

########################################
# Determines if the user has already run this installer script.
# Arguments:
#   None.
# Returns: 
#   true or false
########################################
function user_has_installed {
  local install_files
  install_files="$(find ${OSC_ROOT_DIR}/${CATALOG} -print)"
  local file
  for file in "${install_files}"; do
    if [[ $(expr match "${file}" .*${BACKUP_SUFFIX}) -gt 0 ]]; then
      echo true
      return
    fi
  done
  echo false
}

########################################
# Guesses whether the specified directory is the root directory of an
# OSC installation
# Arguments:
#   directory Directory to check.
# Returns:
#   true or false
########################################
function is_osc_directory {
  local directory="${1}"
  if [[ -d "${directory}/${CATALOG}" ]]; then
    echo true
  else
    echo false
  fi
}

########################################
# Install a single source file. Assumes that the destination directory
#   already exists.
# Arguments:
#   source_file Source file to install.
########################################
function install_file {
  local source_file="${1}"
  local osc_golden_file
  osc_golden_file="$(get_osc_golden_file ${source_file})"
  local install_file
  install_file="$(get_install_file ${source_file})"
  
  echo "Installing ${install_file}"

  if [[ -f "${install_file}" ]]; then
    backup "${install_file}"
  fi
  
  if [[ -f "${install_file}" ]]; then
    echo "Merged changes into ${install_file}"
    merge_message="$(merge -A -L 'YOURS' -L 'OSCOMMERCE' -L 'GOOGLE CHECKOUT' \
        ${install_file} ${osc_golden_file} ${source_file} 2>&1)"
    if [[ "${merge_message}" != "" ]]; then
      MERGE_ERROR=true
      MERGE_ERROR_LIST=("${MERGE_ERROR_LIST[@]}" "${install_file}")
      echo "$(line)"
      echo -e "| An error occurred while attempting to merge"
      echo -e "| "
      echo -e "|   ${source_file}"
      echo -e "| "
      echo -e "|  into"
      echo -e "| "
      echo -e "|   ${install_file}"
      echo -e "| "
      echo -e "| Please manually edit ${install_file}"
      echo -e "| to remove any remaining merge markers."
      echo -e "$(line)"
    fi
  else  
    cp "${source_file}" "${install_file}"
    
    # Make sure the file we copied kept the correct permissions.
    chmod o+r ${install_file}
  fi
}

########################################
# Uninstall (restore) a single source file.
# Arguments:
#   sorce_file Source file to uninstall.
########################################
function uninstall_file {
  local source_file="${1}"
  local osc_golden_file
  osc_golden_file="$(get_osc_golden_file ${source_file})"
  local install_file
  install_file="$(get_install_file ${source_file})"
  local backup_file
  backup_file="$(get_backup_file ${install_file})"
  
  if [[ -f "${osc_golden_file}" ]]; then
    # We should find a back up file.
    if [[ -f "${backup_file}" ]]; then
      echo "Restoring ${install_file} from ${backup_file}"  
      rm "${install_file}" 
      cp "${backup_file}" "${install_file}"
      rm "${backup_file}"
      
      # Make sure the file we copied kept the correct permissions.
      chmod o+r ${install_file}
    else
      echo "Couldn't find ${backup_file}."
      if [[ -f "${install_file}" ]]; then
        echo "Leaving ${install_file} intact."
      fi
      echo "Did you install first?"
    fi
  else
    # We don't expect to find a back up file.
    if [[ -f "${install_file}" ]]; then
      echo "Removing ${install_file}"
      rm "${install_file}"
    else
      echo "Couldn't find ${install_file}, but was going to remove it anyway."
    fi
  fi
}

########################################
# Prints out test data.
# Arguments:
#   None.
########################################
function test {
  local source_files
  source_files="$(find catalog -print)"
  local source_file
  for source_file in ${source_files}; do
    if [[ -f "${source_file}" && ! "${source_file}" =~ '.*\.svn.*' ]]; then
      osc_golden_file="$(get_osc_golden_file ${source_file})"
      install_file="$(get_install_file ${source_file})"
      backup_file="$(get_backup_file ${install_file})"
      debug "Source:     ${source_file}"
      debug "OSC Golden: ${osc_golden_file}"
      debug "Install:    ${install_file}"
      debug "Backup:     ${backup_file}"
    fi
  done
}

########################################
# Sets appropriate permissions on log files.
# Arguments:
#   None.
########################################
function set_log_permissions {
  for file in ${LOG_FILES[@]}; do
    chmod_and_log 777 $(get_install_file ${file})
  done
}

########################################
# Performs a full installation.
# Arguments:
#   None.
########################################
function install {
  if [[ "$(user_has_installed)" == true ]]; then
    echo "You appear to have already installed. Please uninstall first."
    exit 0
  fi
  
  local source_files
	source_files="$(find ${CATALOG} -print)"	
	
	# Before copying any files, create any directories that don't already exist.
	local source_directory
  for source_directory in ${source_files}; do
    if [[ -d "${source_directory}" ]]; then
      local install_directory="$(get_install_file ${source_directory})"
      if [[ ! -d "${install_directory}" ]]; then
        # Note: We depend on 'find' to list parents before their children.
        mkdir ${install_directory}
        chmod a+rx ${install_directory}
      fi
    fi
  done 
	
	# With directories in place, install the files.
	local source_file
	for source_file in ${source_files}; do
	  if [[ -f "${source_file}" && ! "${source_file}" =~ '.*\.svn.*' ]]; then
	    install_file "${source_file}"
    fi
  done
  
  # Set the permission on the log files.
  set_log_permissions
  
  # Print error messages for bad merges.
  if [[ $MERGE_ERROR == true ]]; then
    echo "$(line)"
    echo -e "| Merge errors occurred in the following files:"
    echo -e "| "
    for file in ${MERGE_ERROR_LIST[@]}; do
      echo -e "|   ${file}"
    done
    echo -e "| "
    echo -e "| Please manually edit these files"
    echo -e "| to remove any remaining merge markers."    
    echo "$(line)"
  fi
}

########################################
# Performs a full uninstall (restore).
# Arguments:
#   None.
########################################
function uninstall {
  if [[ "$(user_has_installed)" != true ]]; then
    echo "You don't appear to have installed yet. Please install first."
    exit 0
  fi
  
  local source_files
  source_files="$(find $CATALOG -print)"
  
  # Uninstall individual files.
  local source_file
  for source_file in ${source_files}; do
    if [[ -f "${source_file}" && ! "${source_file}" =~ '.*\.svn.*' ]]; then
      uninstall_file "${source_file}"
    fi
  done
  
  # Remove the installed googlecheckout directory.
  rm -r "$(get_install_file ${GOOGLECHECKOUT})"
}

########################################
# Is this script being run from the right directory?
# Arguments:
#   None.
########################################
function running_in_correct_directory {
  if [[ -f "install.bat" ]]; then
    echo true
  else
    echo false
  fi
}

########################################
# Main control flow.
# Arguments:
#   None.
########################################
function main {
  # Check if we're running in the right directory.
  if [[ "$(running_in_correct_directory)" != true ]]; then
    echo "Please run from root of the unzipped Google Checkout plugin directory."
    exit 0
  fi
  
  # That that we have the right number of command line arguments.
  if [[ "$#" -lt 1 || "$#" -gt 2 ]]; then
    help
  fi
  
  # Commands requiring one parameter.
  if [[ "$#" -eq 1 ]]; then
    local command="${1}"
    case ${command} in
      help)
        help;;
      *)
        help;;
    esac
  fi
  
  # Commands requiring two parameters.
  if [[ "$#" -eq 2 ]]; then
    local command="${1}"
    OSC_ROOT_DIR="${2}"
    if [[ "$(is_osc_directory ${OSC_ROOT_DIR})" != true ]]; then
      echo "${OSC_ROOT_DIR} does not appear to be an osCommerce installation. Exiting."
      exit 0
    fi
    case ${command} in
      install)
        install;;
      uninstall)
        uninstall;;
      reinstall)
        uninstall; install;;
      test)
        test;;
      *)
        help;;
    esac
  fi
}

# Execute main function, passing along all command line args.
main "$@"
