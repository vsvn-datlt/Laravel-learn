# Base image
FROM ubuntu:focal

# Install system dependencies
RUN apt update && apt upgrade -y && \
    apt install -y curl zip unzip nano wget tmux git net-tools && \
    rm -rf /var/lib/apt/lists/* && \
    apt autoremove -y

# Install Composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt install -y nodejs

# Install XAMPP
RUN apt update && apt install -y wget gnupg2 && \
    wget https://udomain.dl.sourceforge.net/project/xampp/XAMPP%20Linux/8.0.28/xampp-linux-x64-8.0.28-0-installer.run -O /root/xampp-installer.run && \
    chmod +x /root/xampp-installer.run && echo "Y" | /root/xampp-installer.run && rm -rf /root/xampp-installer.run

RUN sed -i 's/Require local/# Require local\n    Order allow,deny\n    Allow from all\n    Require all granted/g' /opt/lampp/etc/extra/httpd-xampp.conf && \
    echo "PATH=/opt/lampp/bin:$PATH" >> ~/.bashrc

RUN echo  "#!/bin/bash\n\n# Loop forever\nwhile true\ndo\n   # Sleep for 10 seconds\n   sleep 10\ndone" | tee /root/script.sh && \
    chmod +x /root/script.sh

# Start XAMPP in the background
EXPOSE 80 443 3306
WORKDIR /opt/lampp/htdocs/app
CMD /opt/lampp/xampp start -DFOREGROUND && /root/script.sh
