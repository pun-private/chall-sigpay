FROM php:8-apache

COPY src /var/www

COPY config /etc/apache2/sites-available

RUN a2enmod rewrite
RUN service apache2 restart

HEALTHCHECK --interval=30s --timeout=3s CMD curl http://localhost/
