
# Installation Guide for the Multicoin Faucet on Raspberry PI
**This is working on Raspberry Pi2-Pi4, Altcoin Wallet installation _required_**

Before to start using this Guide you must have a full synced and running Wallet.

1.Create your own home for www-data or phpMyAdmin
  `sudo mkdir /home/www-data`
  `sudo mkdir /home/www-data/www`

2.Download, unzip and rename phpMyadmin
  `cd /home/www-data/www`
  `sudo wget https://files.phpmyadmin.net/phpMyAdmin/4.7.7/phpMyAdmin-4.7.7all-languages.zip`
  `sudo unzip phpMyAdmin-4.7.7-all-languages.zip`
  `sudo mv phpMyAdmin-4.7.7-all-languages phpMyAdmin` 

3.Create .config.inc.php
  `sudo cp /home/www-data/www/phpMyAdmin/config.sample.inc.php /home/wwwdata/www/phpMyAdmin/config.inc.php`

4.Adjust rights
 `sudo chown -R www-data:www-data /home/www-data`
  Now the phpMyAdmin files should be in the following directory: / home / wwwdata / www / phpMyAdmin

5.Edit .config.inc.php
  `sudo nano /home/www-data/www/phpMyAdmin/config.inc.php`
  
  change the following entry
  `$cfg['blowfish_secret'] = ''; <--- between the '' you have to enter a few random characters (maximum 32).`
  
6.Install .Webserver, PHP (+ all necessary modules) and MySQL
  `sudo apt-get install nginx php7.0-fpm php7.0-mysql php7.0-mbstring mysqlserver`
  
7.Edit database with..
  `sudo -i `
  Log in as root (please only do this in exceptional cases) Start the database console
  `mysql -u root -p`
  You will be asked for a password, but no password has been set and therefore you do not have to enter one
  
  Create database for user pi
  `CREATE DATABASE pi;`
  `USE pi;`
  
  Create the User Pi
  `CREATE USER 'pi'@'localhost' IDENTIFIED BY 'ENTER THE PASSWORD HERE';`
  `GRANT ALL PRIVILEGES ON pi.* TO 'pi'@'localhost';`
  `FLUSH PRIVILEGES;`
  `quit`
  
  Log out root
  `exit`
  
8.Save .nginx (web server) configuration
  `sudo cp /etc/nginx/sites-available/default /etc/nginx/sitesavailable/default.backup`
  
  New nginx configuration
  `sudo nano /etc/nginx/sites-available/default`
  
  Adjust the configuration as follows
  
  `server { `
          `listen 80 default_server;`
	  `listen [::]:80 default_server;` 
 
          `root /var/www/html;`
	  `index index.php index.html index.htm index.nginx-debian.html;` 
 
          `server_name _;` 
 
           `location / {`
	            `try_files $uri $uri/ =404;` 
 
                    `location ~ \.php$ {`
		            `include snippets/fastcgi-php.conf;`
			    `fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;`
	            `}`  
           `}` 
 
           `location /phpMyAdmin {`
	            `root /home/www-data/www;`
		    `index index.php;`
		    `try_files $uri $uri/ =404;` 
 
                    `location ~ /phpMyAdmin/(.+\.php)$ {`
		             `include snippets/fastcgi-php.conf;`
			     `fastcgi_param SCRIPT_FILENAME`
			     `$document_root$fastcgi_script_name;`
			     `fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;`
	            `}`
           `}
  `}`
  
  
  If you use a DynDNS service, the underscore at server_name _; replace with the domain name.
  
  example
  `server_name domain.dyndns.com;`
  
  Restart nginx
  `sudo service nginx restart`
  
  Then you should see the test page of nginx in the browser under the IP or the domain name of your Raspberry Pi.
  So as an example http://192.168.0.1 leads to the test page.
  
  If you enter http://192.168.0.1/phpMyAdmin you will see the admin interface for mysql.
 
  You can also log in with the user pi and the password you specified during installation.
  
  Now when you create a website, you do it in the / var / www (document root) folder. The test page is already there. 
  You can delete it
  or just leave it there. As soon as you create an index.php, index.htm or index.html this file is automatically used as an index.
  

9.Download the Faucet Script 
  `cd /var/www/html`
  `git clone https://github.com/worgon12/Multicoin-Faucet.git`
  `cp -r Multicoin-Faucet/* /var/www/html/`
  
  
10. Create database for the user
   `mysql -u root -p`
   `-> enter root password`
   `"You are now logged in as mysql User"`
   `CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password';`
   -> replace the new user e.g. dur user pi and the password between the quotes
   `CREATE DATABASE faucet;`
   `Grant All Privileges ON faucet.* TO 'neuerbenutzer'@'localhost';`
   -> Replace the new user with the user you created in the step above
   USE faucet; SOURCE /var/www/html/faucet.sql; -> to fill in the Database with all it's necessary rows
   Quit MySQL with
   `\q `
  
  
11.Next step

   under var / www / html / faucet with
   `sudo nano config.php`
   edit the config, or enter the data of the crypto wallet to be installed...
  
 

12. Install Crypto Wallet in my case Bitradio
    
    `wget https://github.com/thebitradio/Bitradio/releases/download/1.1.0.10/arm-linux-gnueabihf.zip`
    unpack the bitradio-qt in the bin folder
    
    For example, let the Raspberry boot into desktop mode, start bitradio.qt and let it sync. and with
    `sudo nano /home/pi/.bitradio/bitradio.conf`
    edit the bitradio.conf file

   to access the faucet from the wallet
   `rpcuser = create`
   `rpcpassword = create`
   `rpcport required by the wallet`
   
   All of this also includes your mysql access data in the Faucet config.php under
   `sudo nano var / www / html / faucet / config.php`
   
   Restart the Raspberry ... so you can call up the faucet at your created web address, and when the wallet is running you can also have    coins paid out ...
   
   




**_Install SSL Certificates_**

If you want to add a SSL-certificate I recommend you using certbot: https://certbot.eff.org/

You should install the certificate before the Faucet installation. Just follow the installation guide on the website.






	
