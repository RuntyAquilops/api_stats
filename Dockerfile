FROM php:7.4.12-apache
RUN apt-update &&
	apt-get upgrade -y &&
	docker-php-ext-install mysqli &&
	apt install curl -y
