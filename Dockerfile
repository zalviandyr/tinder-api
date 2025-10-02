FROM jkaninda/nginx-php-fpm:8.4

COPY . /var/www/html
COPY .env.docker .env
COPY docker/nginx/nginx-site.conf /var/www/html/conf/nginx/nginx-site.conf

RUN composer install --no-dev --optimize-autoloader
RUN php artisan key:generate
RUN php artisan config:clear
RUN php artisan config:cache

# Fix permissions
RUN chown -R www-data:www-data /var/www/html
