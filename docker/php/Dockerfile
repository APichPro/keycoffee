FROM php:7.2-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends vim curl debconf subversion git apt-transport-https apt-utils php*-mysql\
    build-essential locales acl mailutils wget zip unzip \
    gnupg gnupg1 gnupg2

COPY php.ini /etc/php/7.2/php.ini
COPY php-fpm-pool.conf /etc/php/7.2/pool.d/www.conf

#RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
#   mv composer.phar /usr/local/bin/composer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN groupadd dev -g 999
RUN useradd dev -g dev -d /home/dev -m

RUN docker-php-ext-install pdo pdo_mysql 

RUN rm -rf /var/lib/apt/lists/*
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

WORKDIR /home/wwwroot/

EXPOSE 9000
CMD ["php-fpm"]