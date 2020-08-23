FROM romeoz/docker-apache-php:7.3

## TODO : Update the docker command
#RUN apt-get install php*-imap php*-mbstring php*-mcrypt && sudo apache2ctl graceful

WORKDIR /var/www/app

RUN rm index.php

EXPOSE 80 443
