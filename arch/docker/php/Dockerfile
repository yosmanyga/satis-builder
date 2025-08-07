# php:8.4-fpm-bookworm, Aug 4, 2025 at 10:06 pm
FROM php@sha256:57a7b038fd845806447557c95503fd3f08d45cb8e549f7e3dcc8210b08642382

RUN apt-get update

# Install xdebug php extension
RUN pecl install xdebug-3.4.5 && docker-php-ext-enable xdebug
