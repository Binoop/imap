FROM romeoz/docker-apache-php:7.3

WORKDIR /var/www/app

RUN rm index.php

EXPOSE 80 443

