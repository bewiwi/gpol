GpoL
====
GPO-Linux is a project to implement script on boot and on login on GNU/Linux system like GPO on Windows computers.

GPOL managment is a web site based on symfony usable on LAMP environment. The client part is bash script in init.d and
profile.d folder.


Installation:
====
First install the web manager :
>$cd /var/www

>$git clone https://github.com/pmsipilot/gpol.git

>$cd gpol

>$mv config/databases.yml-dist config/databases.yml

Edit the database config file with your database information with :
>$vi config/databases.yml

and after :
>$php symfony install

Next you must configure your web server
ex with apache :

    <VirtualHost *:80>
	    ServerName gpol
	    ServerAdmin webmaster@localhost
	    DocumentRoot /var/www/gpol/web

	    Alias /sf  /var/www/gpol/lib/vendor/symfony/data/web/sf
	    <Directory /var/www/gpol>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride All
                Order allow,deny
                allow from all
	    </Directory>
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>


Now  you can access to the interface with admin user and password admin.
You should **change the password** in the config menu.

The next step is the client instalation.

To do that please verify in the web manager configuration menu that the enable\_script\_download variable is set to 1.

In the client computer download the install script:

if your web manager is on URL : http://gpol/

>$wget http://gpol/script/install.sh

With root user
>\#bash install.sh http://gpol/

Now you can see the computer in the web interface and in the next login of the user you can see the user.

Log
====
On the client you have 2 files of log:

The first is /var/log/gpol.log -> log of boot gpol

The second is in ~/.gpol.log -> log of user gpol



Contact
====
PORTE Loïc (@bewiwi) loic.porte@bibabox.fr