FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client \
    curl \
    git \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-install pdo_mysql mbstring gd xml

WORKDIR /var/www/html

COPY . /var/www/html
RUN if [ ! -d vendor ]; then composer install --no-interaction --prefer-dist --no-progress; fi

RUN chown -R www-data:www-data /var/www/html
RUN a2enmod rewrite
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN echo '<VirtualHost *:80>\n    DocumentRoot /var/www/html/web\n    <Directory "/var/www/html/web">\n        AllowOverride All\n        Require all granted\n    </Directory>\n</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]
