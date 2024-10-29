# Installation Guide

This project is programmed using Laravel 5.1. The best way of recreating the server and running the application is to follow Laravel documentation. However, I will provide the following instructions for additional support.

## Operating System
Ubuntu Server 20.04 LTS (HVM), SSD Volume Type

## Server Setup

1. **Install LAMP Stack**  
   Start by installing required packages to set up the LAMP stack:

   ```bash
   sudo apt install zip unzip software-properties-common
   sudo add-apt-repository ppa:ondrej/php
   sudo apt install -y php7.4 php7.4-gd php7.4-mbstring php7.4-xml php-zip
   sudo apt install apache2 libapache2-mod-php7.4
   sudo apt install mysql-server php7.4-mysql
   sudo mysql_secure_installation
   ```

2. **MySQL Database Configuration**  
   Log in to MySQL and configure the database:

   ```bash
   mysql -u root -p
   ```

   Once logged in, execute the following commands:

   ```sql
   CREATE DATABASE [DATABASE_NAME];
   CREATE USER '[DATABASE_USER]'@'localhost' IDENTIFIED BY '[DATABASE_PASSWORD]';
   GRANT ALL ON [DATABASE_NAME].* TO '[DATABASE_USER]'@'localhost';
   ALTER USER '[DATABASE_USER]'@'localhost' IDENTIFIED WITH mysql_native_password BY '[DATABASE_PASSWORD]';
   FLUSH PRIVILEGES;
   QUIT;
   ```

3. **Clone the Repository**  
   Navigate to `/var/www` and clone the repository:

   ```bash
   cd /var/www
   git clone git@github.com:pedramvdl31/HOMVIZ.git
   ```

4. **Set Permissions**  
   Navigate into the HOMVIZ folder and set the permissions:

   ```bash
   chmod -R 777 storage
   chmod -R 777 bootstrap/cache
   ```

5. **Create Environment File**  
   Create an environment file in the project folder `.env`:

   ```bash
   touch .env
   nano .env
   ```

6. **Generate Laravel Server Key**  
   Generate the Laravel server key:

   ```bash
   php artisan key:generate
   ```

7. **Configure Environment Variables**  
   Open the `.env` file and add the following text, then save:

   ```plaintext
   APP_ENV=local
   APP_DEBUG=1
   APP_KEY=[LARAVEL_KEY]
   SERVER_KEY=[JAVA_SERVER_ENCRYPTION_KEY]

   DB_HOST=localhost
   DB_DATABASE=[DATABASE_NAME]
   DB_USERNAME=[DATABASE_USER]
   DB_PASSWORD=[DATABASE_PASSWORD]

   CACHE_DRIVER=file
   SESSION_DRIVER=file
   QUEUE_DRIVER=sync
   ```

8. **Install Composer**  
   Install Composer:

   ```bash
   sudo apt install php-cli unzip
   cd ~
   curl -sS https://getcomposer.org/installer -o composer-setup.php
   HASH=`curl -sS https://composer.github.io/installer.sig`

   php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

   sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
   ```

## Apache Server Configuration

1. **Configure Apache Virtual Host**  
   Navigate to `/etc/apache2/sites-available/`, edit or create `000-default.conf` and add the following configuration:

   ```plaintext
   <VirtualHost *:80>

       ServerAdmin webmaster@localhost
       DocumentRoot /var/www/HOMVIZ/public

       <Directory />
           Options FollowSymLinks
           AllowOverride None
       </Directory>
       <Directory /var/www/HOMVIZ>
           AllowOverride All
       </Directory>

       ErrorLog ${APACHE_LOG_DIR}/error.log
       CustomLog ${APACHE_LOG_DIR}/access.log combined

   </VirtualHost>
   ```

   Enable rewrite module and restart Apache:

   ```bash
   sudo a2enmod rewrite
   systemctl restart apache2
   ```

2. **Run Database Migrations**  
   From the project folder, run the following command:

   ```bash
   php artisan migrate
   ```

## SSL Configuration (Optional)

1. **Generate SSL Certificate**  
   You can use [Certbot](https://certbot.eff.org/) to generate an SSL certificate.

2. **Configure SSL Virtual Host**  
   Add the following to your SSL configuration file:

   ```plaintext
   <IfModule mod_proxy.c>
     ProxyRequests Off
   </IfModule>

   <VirtualHost *:80>
      ServerName [YOUR_SERVER_URL]
      ServerAlias www.[YOUR_SERVER_URL]
      Redirect / https://[YOUR_SERVER_URL]
   </VirtualHost>

   <IfModule mod_ssl.c>

   <VirtualHost *:443>
       ServerAdmin [YOUR_SERVER_URL]
       DocumentRoot /var/www/HOMVIZ/public

       <Directory />
           Options FollowSymLinks
           AllowOverride None
       </Directory>
       <Directory /var/www/HOMVIZ>
           AllowOverride All
       </Directory>

       ErrorLog ${APACHE_LOG_DIR}/error.log
       CustomLog ${APACHE_LOG_DIR}/access.log combined

       ServerName [YOUR_SERVER_URL]
       ServerAlias www.[YOUR_SERVER_URL]
       SSLCertificateFile /etc/letsencrypt/live/[YOUR_SERVER_URL]/fullchain.pem
       SSLCertificateKeyFile /etc/letsencrypt/live/[YOUR_SERVER_URL]/privkey.pem
   </VirtualHost>
   </IfModule>
   ```

   Enable SSL module:

   ```bash
   a2enmod ssl
   ```

This guide should now help you set up and run the project.

