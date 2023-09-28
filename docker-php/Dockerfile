FROM alpine:latest

ENV APACHE_DOCUMENT_ROOT = /var/www/html

RUN apk update && \
    apk add --no-cache apache2 && \
    rm -rf /var/cache/apk/*

EXPOSE 80

COPY src/index.php $APACHE_DOCUMENT_ROOT

CMD ["httpd", "-D", "FOREGROUND"]