#!/bin/bash
#
# Script for testing the current version of osCommerce against some
# version of the Google Checkout plugin.

# This script can be used to check a zipped version of the GC code (i.e. a 
# featured download on code.google.com, the svn trunk, or an svn branch.
#
# Author: Ed Davisson (ed.davisson@gmail.com)
#

# Temporary directory in which all work will take place.
TMP_DIR="/home/$USER/google-checkout-oscommerce/installer-test"

# osCommerce constants.
OSC_ZIP_FILE="oscommerce-2.2rc2a.zip"
OSC_ZIP_URL="http://www.oscommerce.com/ext/${OSC_ZIP_FILE}"
OSC_ZIP_UNZIPPED_DIR="oscommerce-2.2rc2a"
OSC_ZIP_ROOT_DIR="${OSC_ZIP_UNZIPPED_DIR}"

# Base URL for Google Checkout SVN project.
GC_BASE_URL="http://google-checkout-oscommerce.googlecode.com"

# Google Checkout zip download constants.
GC_ZIP_FILE="google-checkout-oscommerce-v1.4.5a.zip"
GC_ZIP_DOWNLOAD_URL="${GC_BASE_URL}/files/${GC_ZIP_FILE}"
GC_ZIP_UNZIPPED_DIR="osc_googlecode"
GC_ZIP_ROOT_DIR="${GC_ZIP_UNZIPPED_DIR}/trunk"

# Google Checkout SVN trunk constants.
GC_SVN_TRUNK_URL="${GC_BASE_URL}/svn/trunk"
GC_SVN_TRUNK_ROOT_DIR="google-checkout-oscommerce-trunk"

# Google Checkout SVN branch constants.
GC_SVN_BRANCH="1.5dev"
GC_SVN_BRANCH_URL="${GC_BASE_URL}/svn/branches/${GC_SVN_BRANCH}"
GC_SVN_BRANCH_ROOT_DIR="google-checkout-oscommerce-branch-${GC_SVN_BRANCH}"

# Installer script.
INSTALLER="install.sh"

# Logging and error reporting.
LOG_FILE="test_installer.log"
DO_EMAIL_IF_SUCCESS=true
DO_EMAIL_IF_ERROR=true
SUBJECT_SUCCESS="google-checkout-oscommerce installation succeeded"
SUBJECT_ERROR="google-checkout-oscommerce installation FAILED"
EMAIL=""

# Message indicating that installer ran into an error.
ERROR_MESSAGE="error occurred"

########################################
# Help/usage.
# Arguments:
#   None.
########################################
function help {
  echo "Usage: ${0} { branch | trunk | zip | cleanup }"
  exit 0
}

########################################
# Downloads a zip file, unzips it, and deletes the file.
# Arguments:
#   url. URL from which to download the file.
#   file. Filename of saved zip file.
########################################
function download_zip_file {
  local url=${1}
  local file=${2}
  echo "Downloading ${url} to ${file}"
  curl ${url} > ${file}
  unzip ${file}
  rm ${file}
}

########################################
# Doanloads an svn directory to the specified local directory.
# Arguments:
#   url. URL of SVN repository.
#   local_directory. Local directory.
########################################
function download_svn_directory {
  url=${1}
  local_directory=${2}
  rm -rf $local_directory
  svn checkout $url $local_directory
}

########################################
# Get osCommerce, and unzip it.
# Arguments:
#   None.
########################################
function get_osc {
  download_zip_file ${OSC_ZIP_URL} ${OSC_ZIP_FILE}
}

########################################
# Test install.
# Arguments:
#   osc_root. Root directory of OSC installation
#   gc_root. Root directory of Google Checkout plugin installation.
########################################
function test_install {
  osc_root=${1}
  gc_root=${2}
  pushd ${gc_root}
  echo "cd'ed to $(pwd)"
  # TODO(eddavisson): The '..' is fragile.
  if [[ -f ./${INSTALLER} ]]; then
    ./${INSTALLER} install ../${osc_root} > ${LOG_FILE}
    cat ${LOG_FILE}
    if [[ $(grep "${ERROR_MESSAGE}" ${LOG_FILE}) != "" ]]; then
      if [[ ${DO_EMAIL_IF_ERROR} == true ]]; then
        cat ${LOG_FILE} | mail -s "${SUBJECT_ERROR}" ${EMAIL}
      fi
    fi
    ./${INSTALLER} uninstall ../${osc_root}
  else
    echo "Could not find ./${INSTALLER}"
  fi
  popd
  echo "cd'ed to $(pwd)"
}

########################################
# Deletes a file iff it exists.
# Arguments:
#   File. File to delete.
########################################
function delete_file_if_exists {
  local file=${1}
  if [[ -f ${file} ]]; then
    echo "Deleting ${file}"
    rm ${file}
  fi
}

########################################
# Deletes a directory iff it exists.
# Arguments:
#   Directory. Directory to delete.
########################################
function delete_directory_if_exists {
  local directory=${1}
  if [[ -d ${directory} ]]; then
    echo "Deleting ${directory}"
    rm -rf ${directory}
  fi
}

########################################
# Removes files and directories created by this script.
# Arguments:
#   None.
########################################
function cleanup {
  delete_file_if_exists ${OSC_ZIP_FILE}
  delete_file_if_exists ${GC_ZIP_FILE}
  delete_directory_if_exists ${OSC_ZIP_UNZIPPED_DIR}
  delete_directory_if_exists ${GC_ZIP_UNZIPPED_DIR}
  delete_directory_if_exists ${GC_SVN_BRANCH_ROOT_DIR}
  delete_directory_if_exists ${GC_SVN_TRUNK_ROOT_DIR}
}

########################################
# Test Google Checkout code in trunk.
# Arguments:
#   None.
########################################
function test_gc_trunk {
  get_osc
  download_svn_directory ${GC_SVN_TRUNK_URL} ${GC_SVN_TRUNK_ROOT_DIR}
  test_install ${OSC_ZIP_UNZIPPED_DIR} ${GC_SVN_TRUNK_ROOT_DIR}
  notify trunk
  cleanup
}

########################################
# Test Google Checkout code in branch.
# Arguments:
#   None.
########################################
function test_gc_branch {
  get_osc
  download_svn_directory ${GC_SVN_BRANCH_URL} ${GC_SVN_BRANCH_ROOT_DIR}
  test_install ${OSC_ZIP_UNZIPPED_DIR} ${GC_SVN_BRANCH_ROOT_DIR}
  notify "branch:${GC_SVN_BRANCH}"
  cleanup
}

########################################
# Test Google Checkout code in a zip file.
# Arguments:
#   None.
########################################
function test_gc_zip {
  get_osc
  download_zip_file ${GC_ZIP_DOWNLOAD_URL} ${GC_ZIP_FILE}
  test_install ${OSC_ZIP_UNZIPPED_DIR} ${GC_ZIP_ROOT_DIR}
  notify zip
  cleanup
}

########################################
# Send a quick notification email that nothing went wrong.
# Arguments:
#   type. Type of test that was run.
########################################
function notify {
  type=${1}
  if [[ ${DO_EMAIL_IF_SUCCESS} == true ]]; then
    echo "OSC/GC installer for (${type}) succeeded" \
        | mail -s "${SUBJECT_SUCCESS}" ${EMAIL}
  fi
}

########################################
# Main control flow.
# Arguments:
#   None.
########################################
function main {
  # Check that we have the right number of command line arguments.
  if [[ "$#" -eq 1 ]]; then
    if [[ ! -d ${TMP_DIR} ]]; then
      mkdir ${TMP_DIR}
    fi
    pushd ${TMP_DIR}
    echo "cd'ed to $(pwd)"
    local command="${1}"
    case ${command} in
      branch)
        test_gc_branch;;
      trunk)
        test_gc_trunk;;
      zip)
        test_gc_zip;;
      cleanup)
        cleanup;;
      *)
        help;;
    esac
    popd
    echo "cd'ed to $(pwd)"
  else
    help
  fi 
}

# Execute main function, passing along all command line args.
main "$@"