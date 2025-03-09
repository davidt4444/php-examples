### Install PHP

#### Windows
Install IIS by enabling it in the "Turn Windows features on or off"
Download the binaries from here 
https://windows.php.net/download/
In the base dir for the hard disk (c:\) run 
mkdir php
Unzip the downloaded files into the new php directory, 
put the php directory in the path variable
and add .php to the pathext variable
Restart VSCode to update path
inside c:\php
copy php.ini-development php.ini
uncomment the following 
extension=openssl 
extension=mbstring 
extension=zip
extension=fileinfo 
extension=mysqli 
extension=pdo_mysql
and
set allow_url_include = On 

take the install script from 
https://www.php.net/manual/en/install.windows.iis.php
and put it in a file named phpinstall.bat 
Open an admin cmd prompt
cd C:\Users\david\Documents\github\php-examples
run
phpinstall.bat

https://www.php.net/manual/en/install.windows.commandline.php
assoc .php=phpfile
ftype phpfile="C:\php\php.exe" -f "%1" -- %~2

#### Ubuntu
Install Apache first
https://documentation.ubuntu.com/server/how-to/web-services/install-apache2/#install-apache2
sudo apt install apache2

Install php
https://documentation.ubuntu.com/server/how-to/web-services/install-php/index.html
sudo apt install php libapache2-mod-php
sudo apt install php-cli
sudo apt install php-mysql
sudo apt-get install php-dom

sudo systemctl restart apache2.service 


### Install Composer
https://getcomposer.org/download/

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"

In windows
sudo move composer.phar c:/php/composer.php
In Ubuntu
sudo mv composer.phar /usr/local/bin/composer

