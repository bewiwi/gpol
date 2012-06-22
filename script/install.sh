#!/bin/bash
TMP_FOLDER='/tmp'


##check root
if [ "$(id -u)" != "0" ]; then
   echo "This script must be run as root" 1>&2
   exit 1
fi

function testcommand {
    hash $1 2>&-  
    if [[ $? != 0 ]]
    then
        echo "ERROR no $1 detected "
        exit 1
    fi
    echo "$1 - OK"
}

#check URL
if [ -z "$1" ]
then
	echo "No URL specified"
	echo "Usage :"
	echo "$0 URL"
	echo "ex : $0 http://gpo/"
	exit 1
fi

URL=$1

#check curl
testcommand curl
testcommand dmidecode

#get script
for SCRIPT in  gpol gpol.conf gpol.profil.sh getgpol
do
    ret=$(curl --write-out %{http_code} --silent --out /dev/null $URL/script/gpol)
    if [[ $ret -gt 400 ]]
    then
        echo "ERROR HTTP $ret"
        echo "Check link and check if the script are network accessible (Config menu)"
        exit 1
    fi
    curl $URL/script/$SCRIPT -o $TMP_FOLDER/$SCRIPT -s
    if [[ $? != 0 ]]
    then
        echo "ERROR with $URL "
        exit 1
    fi

done

###GPOL.CONF ###
if [ ! -d /etc/gpol/ ]; then
	mkdir -p /etc/gpol/
fi
URL2=$(echo $URL|sed 's/\//\\\//g')
sed -i "s/^URL_SERVER_GPOL=.*/URL_SERVER_GPOL=${URL2}/g" $TMP_FOLDER/gpol.conf
mv $TMP_FOLDER/gpol.conf /etc/gpol/


###GPOL.PROFIL.SH###
mv $TMP_FOLDER/gpol.profil.sh /etc/profile.d/
chmod +x  /etc/profile.d/gpol.profil.sh

####GETGPOL###
mv $TMP_FOLDER/getgpol /usr/bin/
chmod +x  /usr/bin/getgpol

##CRONTAB###
echo "PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin">/etc/cron.d/gpol
echo "*/15 * * * *	root	/usr/bin/getgpol > /dev/null" >> /etc/cron.d/gpol

###GPOL INIT###
mv $TMP_FOLDER/gpol /etc/init.d/
chmod +x /etc/init.d/gpol

#Debian/Ubuntu??
hash update-rc.d 2>&- &&   update-rc.d gpol defaults 98 02

#Mandriva/Mageia/CentOs/RedHat ...
if [[ $? != 0 ]]
then
    hash chkconfig   2>&- &&   chkconfig gpol on
else
    if [[ $? != 0 ]]
    then
        echo 'Please set /etc/init.d/gpol start on boot'
    fi
fi

#Get Gpol
/usr/bin/getgpol


echo 'Install OK'
exit 0
