FROM bitnami/php-fpm
RUN apt-get -y update
RUN apt-get -y install autoconf gcc make
RUN pecl config-set php_ini /opt/bitnami/php/etc/php.ini
RUN pecl install redis
ADD ./php.conf /opt/bitnami/php/etc/php-fpm.conf
ADD ./www.conf /opt/bitnami/php/etc/php-fpm.d/www.conf
ADD ./php.ini /opt/bitnami/php/etc/php.ini
ADD . /app
RUN chmod 755 /app/install-composer.sh
RUN /app/install-composer.sh
WORKDIR /app
RUN composer install