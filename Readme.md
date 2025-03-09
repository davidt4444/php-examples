### Install PHP


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

### Install Composer
https://getcomposer.org/download/
cd c:\php
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"

sudo copy composer.phar composer.php

