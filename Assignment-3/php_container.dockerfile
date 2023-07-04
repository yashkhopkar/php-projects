FROM php:8-fpm-alpine

ENV PHPGROUP=laravelhumber

ENV PHPUSER=laravelhumber

RUN adduser -g ${PHPGROUP} -s /bin/sh -D ${PHPUSER}

RUN sed -i 's/user = www-data/user = ${PHPUSER}/g' /usr/local/etc/php-fpm.d/www.conf

RUN sed -i 's/group = www-data/group = ${PHPGROUP}/g' /usr/local/etc/php-fpm.d/www.conf

RUN mkdir -p /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

# RUN chown -R laravel:laravel /var/www/html

# RUN chmod -R 775 /var/www/html/storage

CMD ["php-fpm","-y","/usr/local/etc/php-fpm.conf","-R"]

