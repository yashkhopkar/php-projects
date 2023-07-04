FROM nginx:stable-alpine

ENV NGINXUSER=laravelhumber

ENV NGINXGROUP=laravelhumber

RUN mkdir -p /var/www/html/public

ADD nginx_data/default.conf /etc/nginx/conf.d/default.conf

RUN sed -i 's/user www-data/user laravel/g' /etc/nginx/nginx.conf

RUN adduser -g ${NGINXGROUP}} -s /bin/sh -D ${NGINXUSER}

