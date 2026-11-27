#!/bin/sh

# Script to collect data
# and put the data into outputfile

CWD=$(dirname $0)
CACHEDIR="$CWD/cache/"
OUTPUT_FILE="${CACHEDIR}backblaze.txt"
SEPARATOR=' = '

# Create cache directory
mkdir -p "${CACHEDIR}" 2>/dev/null

# Business logic goes here
bzpath="/Library/Backblaze.bzpkg/bzdata/bzreports"

# Check if Backblaze is installed, create empty file if not
if [[ ! -f "$bzpath/bzserv_version.txt" ]] || [[ ! -r "$bzpath/bzserv_version.txt" ]]; then
    # Create empty file if Backblaze is not installed
    touch "${OUTPUT_FILE}" 2>/dev/null
    exit 0
fi

bzversion=`cat "$bzpath"/bzserv_version.txt 2>/dev/null` || {
    # Create empty file if version file can't be read
    touch "${OUTPUT_FILE}" 2>/dev/null
    exit 0
}
bzlogin=$(grep -o 'bzlogin="[^"]*"' "$bzpath"/bzdc_synchostinfo.xml | sed 's/bzlogin="//;s/"//')
bzlicense=$(grep -o 'bzlicense="[^"]*"' "$bzpath"/bzdc_synchostinfo.xml | sed 's/bzlicense="//;s/"//')
bzlicense_status=$(grep -o 'bzlicense_status="[^"]*"' "$bzpath"/bzdc_synchostinfo.xml | sed 's/bzlicense_status="//;s/"//')
safety_frozen=$(grep -o 'safety_frozen="[^"]*"' "$bzpath"/bzdc_synchostinfo.xml | sed 's/safety_frozen="//;s/"//')
lastbackupcompleted=$(grep -o 'gmt_millis="[^"]*"' "$bzpath"/bzstat_lastbackupcompleted.xml | sed 's/gmt_millis="//;s/"//')
remainingnumfilesforbackup=$(grep -o 'remainingnumfilesforbackup="[^"]*"' "$bzpath"/bzstat_remainingbackup.xml | sed 's/remainingnumfilesforbackup="//;s/"//')
remainingnumbytesforbackup=$(grep -o 'remainingnumbytesforbackup="[^"]*"' "$bzpath"/bzstat_remainingbackup.xml | sed 's/remainingnumbytesforbackup="//;s/"//')
totnumfilesforbackup=$(grep -o 'totnumfilesforbackup="[^"]*"' "$bzpath"/bzstat_totalbackup.xml | sed 's/totnumfilesforbackup="//;s/"//')
totnumbytesforbackup=$(grep -o 'totnumbytesforbackup="[^"]*"' "$bzpath"/bzstat_totalbackup.xml | sed 's/totnumbytesforbackup="//;s/"//')
encrypted=`cat "$bzpath"/bzflag_user_has_priv_encr_key.txt 2>/dev/null || echo ""`
online_hostname=$(grep -o 'online_hostname="[^"]*"' "/Library/Backblaze.bzpkg/bzdata/bzinfo.xml" | sed 's/online_hostname="//;s/"//')
bztempfile=`du -hd0 --si /Library/Backblaze.bzpkg`
bztempfile_size=$(echo "$bztempfile" | cut -d$'\t' -f1)

if [[ "${safety_frozen}" == "not_frozen" ]]; then
    safety_frozen_boolean=0
else
    safety_frozen_boolean=1
fi

if [[ "${encrypted}" == "true" ]]; then
    encrypted_boolean=1
else
    encrypted_boolean=0
fi

lastbackupcompleted=`expr $lastbackupcompleted / 1000`

bzlicense_status="${bzlicense_status#billing_}"
bzlicense="${bzlicense%_billing}"

# Output data here
{
    echo "bzversion${SEPARATOR}${bzversion}"
    echo "bzlogin${SEPARATOR}${bzlogin}"
    echo "bzlicense${SEPARATOR}${bzlicense}"
    echo "bzlicense_status${SEPARATOR}${bzlicense_status}"
    echo "safety_frozen${SEPARATOR}${safety_frozen_boolean}"
    echo "lastbackupcompleted${SEPARATOR}${lastbackupcompleted}"
    echo "remainingnumfilesforbackup${SEPARATOR}${remainingnumfilesforbackup}"
    echo "remainingnumbytesforbackup${SEPARATOR}${remainingnumbytesforbackup}"
    echo "totnumbytesforbackup${SEPARATOR}${totnumbytesforbackup}"
    echo "totnumfilesforbackup${SEPARATOR}${totnumfilesforbackup}"
    echo "encrypted${SEPARATOR}${encrypted_boolean}"
    echo "online_hostname${SEPARATOR}${online_hostname}"
    echo "bztempfile_size${SEPARATOR}${bztempfile_size}"
} > "${OUTPUT_FILE}" 2>/dev/null || exit 0
