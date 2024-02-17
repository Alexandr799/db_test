FROM php:8.2

RUN apt-get update \
     && docker-php-ext-install mysqli pdo pdo_mysql \
     && docker-php-ext-enable pdo_mysql

RUN pecl install redis && docker-php-ext-enable redis

RUN apt-get -y install zip unzip git wget curl

RUN useradd -ms /bin/bash myuser

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

RUN chmod 755 -R /var/www

RUN chown -R myuser:myuser /var/www

USER myuser