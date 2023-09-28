FROM alpine:latest

ENV APACHE_DOCUMENT_ROOT=/var/www/localhost/htdocs

RUN apk update && \
    apk add --no-cache apache2 && \
    rm -rf /var/cache/apk/*

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80

COPY src/index.php $APACHE_DOCUMENT_ROOT

WORKDIR $APACHE_DOCUMENT_ROOT

CMD ["httpd", "-D", "FOREGROUND"]