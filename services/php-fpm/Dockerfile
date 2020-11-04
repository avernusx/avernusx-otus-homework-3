FROM bitnami/php-fpm
ADD ./php.conf /opt/bitnami/php/etc/php-fpm.conf
ADD ./php.ini /opt/bitnami/php/etc/php.ini
ADD . /app
RUN chmod 755 /app/install-composer.sh
RUN /app/install-composer.sh
WORKDIR /app
RUN composer install