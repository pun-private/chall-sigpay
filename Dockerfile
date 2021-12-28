FROM php:8-apache

RUN a2enmod rewrite
RUN service apache2 restart
