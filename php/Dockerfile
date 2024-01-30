FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get -y install software-properties-common
RUN apt-get update && add-apt-repository ppa:ondrej/php 

RUN apt-get update && apt-get install -y php8.2 php8.2-common php8.2-xml php8.2-gd php8.2-curl php8.2-mcrypt php8.2-mbstring  php8.2-mysql  unzip curl


RUN cd ~ \
    && curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php \
    && HASH=`curl -sS https://composer.github.io/installer.sig` \
    && echo $HASH \
    && php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

CMD ["bash", "-c", "while true; do sleep 1000; done"]