FROM php:8-fpm

ARG user
ARG uid

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

ENV PATH=$PATH:/root/composer/vendor/bin COMPOSER_ALLOW_SUPERUSER=1

RUN chmod uga+x /usr/local/bin/install-php-extensions \
    && sync \
    && DEBIAN_FRONTEND=noninteractive apt update -q \
    && DEBIAN_FRONTEND=noninteractive apt install -qq -y \
      curl \
      git \
      zip unzip \
    && install-php-extensions \
      bcmath \
      pcntl \
      bz2 \
      calendar \
      exif \
      gd \
      intl \
      memcached \
      mysqli \
      opcache \
      pdo_mysql \
      pdo_pgsql \
      pgsql \
      redis \
      soap \
      xsl \
      zip \
      sockets \
      ldap \
      yaml \
      xdebug \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && ln -s $(composer config --global home) /root/composer \
    && apt update \
    && apt upgrade -y \
    && apt install -y libfontconfig1 libxrender1 supervisor gosu \
    && apt clean \
    && rm -rf /var/lib/apt/lists/* \
    && useradd -G www-data,root -u $uid -d /home/$user $user \
    && mkdir -p /home/$user/.composer \
    && chown -R $user:$user /home/$user

USER $user

CMD ["php-fpm"]
