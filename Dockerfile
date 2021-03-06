FROM php:7.4.12-apache

RUN apt-get update && apt-get -y upgrade \
	&& docker-php-ext-install mysqli \
	&& apt-get install curl \
	&& apt-get install -y vim

COPY ./000-default.conf /etc/apache2/sites-available
