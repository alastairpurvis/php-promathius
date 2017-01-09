#!/bin/bash
#
# Script to retrieve current download numbers from code.google.com.
#
# For each file being tracked, this script creates a log file. Every time the
# script is run, and for each file being tracked, it appends a line to the
# corresponding log file with the current date/time, the name of the file being 
# tracked, and the total number of downloads at the time the script was run. 
# It optionally sends an email with a summary of the results.
#
# Before running, you may want to change LOG_DIR, DO_EMAIL, and EMAIL.
#
# Author: Ed Davisson (ed.davisson@gmail.com)
#

# Download list URL on code.google.com.
GC_DOWNLOADS_URL="http://code.google.com/p/google-checkout-oscommerce/downloads/list"

# Names of files to track.
DOWNLOAD_FILES=( \
    "google-checkout-oscommerce-v1.4.5a.zip" \
    "responsehandler_test_v1.2.php" \
    "google-checkout-oscmax-v1.4beta1.2.zip" \
    "google-checkout-oscommerce-1.1.b1-coupon_support.zip" \
    )

# Directory in which results will be stored.
LOG_DIR="/home/$USER/google-checkout-oscommerce/downloads"
LOG_FILE_SUFFIX="downloads.txt"
REPORT_FILE="${LOG_DIR}/report.txt"

# Email options.
DO_EMAIL=true
EMAIL=""
SUBJECT="google-checkout-oscommerce daily download report"

########################################
# Calculate current number of downloads for a single file.
# Arguments:
#   file. Name of file.
########################################
function number_of_downloads {
  file=${1}
  curl ${GC_DOWNLOADS_URL} 2> /dev/null \
      | grep -A 20 "<.*${file}.*>" \
      | grep "^ *[0-9][0-9]* *$" \
      | tr -d " "
}

########################################
# Calculates log line for one file.
# Arguments:
#   file. Name of file.
########################################
function log_downloads {
  file=${1}
  downloads=$(number_of_downloads ${file})
  log_line="$(date), ${downloads}, ${file}"
  echo ${log_line} >> "${LOG_DIR}/${file}-${LOG_FILE_SUFFIX}"
  echo ${log_line} >> ${REPORT_FILE}
}

########################################
# Main control flow.
# Arguments:
#   None.
########################################
function main {
  # Create directory if necessary.
  if [[ ! -d ${LOG_DIR} ]]; then
    mkdir -p ${LOG_DIR}
  fi
  
  # Clear the old report file.
  if [[ -f ${REPORT_FILE} ]]; then
    rm ${REPORT_FILE}
  fi
  
  # Write to logs for each file.
  for file in ${DOWNLOAD_FILES[@]}; do
    log_downloads ${file}
  done
  
  # Email the report.
  if [[ ${DO_EMAIL} == true ]]; then
    cat ${REPORT_FILE} | mail -s "${SUBJECT}" "${EMAIL}"
  fi
}

# Execute main function, passing along all command line args.
main "$@"