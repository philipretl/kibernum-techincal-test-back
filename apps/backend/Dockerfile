FROM php:8.1-fpm

RUN apt-get update && apt-get install -y && apt-get install vim -y\
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip\
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable pdo_mysql

# Set working directory
WORKDIR /var/www/backend

#Install php socket ext
RUN docker-php-ext-install sockets

#Install nvm
ENV NVM_DIR /usr/local/nvm
ENV NODE_VERSION 14.17.1
WORKDIR $NVM_DIR
RUN curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash \
    && . $NVM_DIR/nvm.sh \
    && nvm install $NODE_VERSION \
    && nvm alias default $NODE_VERSION \
    && nvm use default
ENV NODE_PATH $NVM_DIR/versions/node/v$NODE_VERSION/lib/node_modules
ENV PATH      $NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH

RUN npm install

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --version=1.10.15 --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/backend

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/backend

# Set working directory
WORKDIR /var/www/backend

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
