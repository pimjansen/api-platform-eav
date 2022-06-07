FROM php:8.1-fpm-buster

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP package installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Install packages
RUN apt update && apt install -y locales zip && \
    chmod uga+x /usr/local/bin/install-php-extensions && \
    install-php-extensions opcache pdo_mysql && \
    # Setup locales
    echo 'nl_NL.UTF-8 UTF-8' >> /etc/locale.gen && locale-gen && \
    # Use the default production configuration
    mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN groupadd senet -g 1000
RUN useradd senet -u 1000 -g 1000 -m

# Add configuration files for PHP and PHPFPM
COPY ./.docker/phpfpm/conf.d/custom.ini $PHP_INI_DIR/conf.d/
COPY ./.docker/phpfpm/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/

# Disabled access logs for php-fpm
# RUN sed -i 's/access.log = \/proc\/self\/fd\/2/access.log = \/proc\/self\/fd\/1/g' /usr/local/etc/php-fpm.d/docker.conf

USER senet
WORKDIR /app