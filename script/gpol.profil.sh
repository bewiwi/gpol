#!/bin/bash
CONF_FILE=/etc/gpol/gpol.conf
LOG_FILE=".gpol.log"

exec 3>&1 4>&2 1>>$LOG_FILE 2>&1 ;
date
if [ -f $CONF_FILE ]
then
	. $CONF_FILE
fi

if [ -z "$FILE_VAR" ]
then
	echo "FILE_VAR undefined"
	exit 1
fi

if [ -f $FILE_VAR ]
then
	. $FILE_VAR
else
    echo "FILE_VAR unreacheable"
fi

if [ -z "$URL_SERVER_GPOL" ]
then
	echo "URL_SERVER_GPOL undefined"
	exit 1
fi

if [ -z "$TMP_FOLDER" ]
then
	echo "TMP_FOLDER undefined"
	exit 1
fi

login=$(whoami|sed 's/\\/\$/g')

network=$(/sbin/ifconfig | sed -n '
	/^eth/,/^$/{
	1 {
	s/\([^ ]*\).*ddr \(.*\)/\1 \2/p
	}
	2 {
	s/.*adr:\([^ ]*\).*/\1/p
	}
	}' | sed 'N;s/\n//')
ip=$(echo $network|cut -d' ' -f 3)

if [ $ip = "" ]
then
	ip=0
fi
##contact gpol get list gpol to dl
URL=$URL_SERVER_GPOL"getg/login/$serie/$os/$hostname/$ip/$login"
echo $URL
IDS=$(curl "$URL" -s)
#echo $IDS
for ID in $IDS
do

  if [  "`echo $ID | egrep ^[[:digit:]]+$`" = "" ]; then
    echo "Invalid GpoID"
    exit 0
  fi

	curl  $URL_SERVER_GPOL"dl/$serie/$ID" -o $TMP_FOLDER/gpol-$ID -s
	#echo  $URL_SERVER_GPOL"dl/$serie/$ID" -o $TMP_FOLDER/gpol-$ID -s
	chmod +x $TMP_FOLDER/gpol-$ID
	$TMP_FOLDER/gpol-$ID
  #Use to set the connection imposible if the scrit return error
	if [ $? = 1 ]
  then
    echo "GPOL disconnect user : ID: $ID "
    exit 1
  fi
	rm -f $TMP_FOLDER/gpol-$ID
done

exec 1>&3 2>&4 3>&- 4>&- ;
