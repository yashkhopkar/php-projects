FROM composer:2

ENV COMPOSERUSER=laravelhumber

ENV COMPOSERGROUP=laravelhumber

RUN adduser -g ${COMPOSERGROUP} -s /bin/sh -D ${COMPOSERUSER}