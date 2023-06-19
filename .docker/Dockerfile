#
# composer
#
FROM composer:2.0 as composer

COPY database database
COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

#
# node
#
FROM node:19.0-buster as node

RUN mkdir -p /app/public

COPY package.json webpack.mix.js tailwind.config.js /app/
COPY resources/css/ /app/resources/css/
COPY resources/js/ /app/resources/js/

WORKDIR /app

RUN npm install && npm run production


#
# App
#
FROM    php:8.2-apache-buster

# enabling mod rewrite
RUN     a2enmod rewrite

# default vhost replaced by custom one                                                                                                                                                                                          
# mainly documentRoot /app/public       
COPY    .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# disabling php short tags (IE : <? ?>)
COPY    .docker/additionnalConf.ini /usr/local/etc/php/conf.d/

COPY --from=composer /app/vendor/ /app/vendor/
COPY --from=node /app/public/js/ /app/public/js/
COPY --from=node /app/public/css/ /app/public/css/
COPY --from=node /app/mix-manifest.json /app/mix-manifest.json
COPY . /app
WORKDIR /app

