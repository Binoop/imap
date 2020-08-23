FROM romeoz/docker-apache-php:7.3

## Update the server to install php-imap and mb-string and mcrypt libarary

RUN apt-get update  && apt install php*-imap php*-mbstring php*-mcrypt

WORKDIR /var/www/app

RUN rm index.php

EXPOSE 80 443
