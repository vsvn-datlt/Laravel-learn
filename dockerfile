# # Base image
# FROM ubuntu:focal

# # Install system dependencies
# RUN apt update && apt upgrade -y && \
#     apt install -y curl zip unzip nano wget tmux git net-tools && \
#     rm -rf /var/lib/apt/lists/* && \
#     apt autoremove -y

# # Install Composer
# COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# # Install Node.js
# RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
#     apt install -y nodejs

# # Install XAMPP
# RUN apt update && apt install -y wget gnupg2 && \
#     wget https://udomain.dl.sourceforge.net/project/xampp/XAMPP%20Linux/8.0.28/xampp-linux-x64-8.0.28-0-installer.run -O /root/xampp-installer.run && \
#     chmod +x /root/xampp-installer.run && echo "Y" | /root/xampp-installer.run && rm -rf /root/xampp-installer.run

# RUN sed -i 's/Require local/# Require local\n    Order allow,deny\n    Allow from all\n    Require all granted/g' /opt/lampp/etc/extra/httpd-xampp.conf && \
#     echo "<VirtualHost *:80>\n    ##ServerAdmin webmaster@dummy-host.example.com\n    ServerName localhost\n    DocumentRoot /opt/lampp/htdocs/app/public\n\n    <Directory /opt/lampp/htdocs/app>\n        Options Indexes FollowSymLinks MultiViews\n        AllowOverride All\n        Order allow,deny\n        allow from all\n        Require all granted\n    </Directory>\n</VirtualHost>" | tee /opt/lampp/etc/extra/httpd-vhosts.conf && \
#     echo "PATH=/opt/lampp/bin:$PATH" >> ~/.bashrc

# RUN echo  "#!/bin/bash\n\n# Loop forever\nwhile true\ndo\n   # Sleep for 10 seconds\n   sleep 10\ndone" | tee /root/script.sh && \
#     chmod +x /root/script.sh

# # Start XAMPP in the background
# EXPOSE 80 443 3306
# WORKDIR /opt/lampp/htdocs/app
# CMD /opt/lampp/xampp start -DFOREGROUND && /root/script.sh

FROM php:8.2.5-apache

ARG APP_NAME
ARG DB_HOST
ARG DB_PORT
ARG DB_DATABASE
ARG DB_USERNAME
ARG DB_PASSWORD

RUN echo "Build ARG: App: ${APP_NAME} DB: ${DB_HOST}:${DB_PORT}, ${DB_DATABASE}, ${DB_USERNAME}, ${DB_PASSWORD}"

RUN a2enmod rewrite

RUN apt-get update && apt-get upgrade -y

RUN apt-get install -y libzip-dev zip libpng-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql zip gd && docker-php-ext-enable mysqli pdo_mysql zip gd

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY CostManager .
COPY .env.cicd .env

RUN sed -i "s/__APP_NAME__/${APP_NAME}/g; s/__DB_HOST__/${DB_HOST}/g; s/__DB_PORT__/${DB_PORT}/g; s/__DB_DATABASE__/${DB_DATABASE}/g; s/__DB_USERNAME__/${DB_USERNAME}/g; s/__DB_PASSWORD__/${DB_PASSWORD}/g;" .env

COPY .htaccess .

RUN chmod -R 777 .

RUN composer update
RUN composer install

RUN composer install --ignore-platform-reqs

RUN php artisan key:generate
