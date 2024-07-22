FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    mariadb-client \
    cron \
    supervisor \
    mc \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip pdo pdo_mysql \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install sockets

RUN pecl install redis && docker-php-ext-enable redis
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - 
RUN apt-get install -y nodejs

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

WORKDIR /var/www

COPY ./project/ ./
COPY ./conf/supervisor.conf /etc/supervisor/conf.d/laravel.conf

COPY ./conf/laravel-cron /etc/cron.d/laravel-cron
RUN chmod 0644 /etc/cron.d/laravel-cron
RUN crontab /etc/cron.d/laravel-cron
RUN touch /var/log/cron.log

RUN chown -R www-data:www-data /var/www

EXPOSE 9000

#COPY init.sh /usr/local/bin/init.sh
#RUN chmod +x /usr/local/bin/init.sh
#CMD ["/usr/local/bin/init.sh"]

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
