FROM php:7.4-apache

RUN apt-get update && \
    apt-get install -y \
    git \
    libzip-dev \
    zip \
    libicu-dev
RUN docker-php-ext-install pdo_mysql zip intl
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-configure intl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


#RUN echo "ServerName laminas-mvc-tutorial.localhost" >> /etc/apache2/sites-enabled/laminas-mvc-tutorial
#RUN echo "DocumentRoot /laminas-mvc-tutorial/public" >> /etc/apache2/sites-enabled/laminas-mvc-tutorial
#RUN service apache2 restart