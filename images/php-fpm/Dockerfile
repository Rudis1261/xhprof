FROM php:5.6-fpm

# Copy the dev php.ini
COPY config/php.ini /usr/local/etc/php/

# Copy custom scripts in
COPY bin/docker-php-pecl-install /usr/local/bin/

# Enable Reporting
RUN echo ";\n">>/usr/local/etc/php-fpm.conf
RUN echo ";Enabling Error Logging\n">>/usr/local/etc/php-fpm.conf
RUN echo "php_flag[display_errors] = On">>/usr/local/etc/php-fpm.conf
RUN echo "php_admin_flag[log_errors] = On">>/usr/local/etc/php-fpm.conf
RUN echo "php_admin_value[display_errors] = 'stderr'">>/usr/local/etc/php-fpm.conf
RUN echo "php_value[session.save_handler] = redis">>/usr/local/etc/php-fpm.conf
RUN echo "php_value[session.save_path] = 'tcp://redis:6379/'">>/usr/local/etc/php-fpm.conf

# Setting SAST Time
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Africa/Johannesburg /etc/localtime
RUN "date"

# Install modules TODO
RUN apt-get update && apt-get install -y \
libfreetype6-dev \
libjpeg62-turbo-dev \
libmcrypt-dev \
libpng12-dev \
imagemagick

# Copy custom scripts in
COPY bin/docker-php-pecl-install /usr/local/bin/

# Install XHProf
RUN docker-php-pecl-install "channel://pecl.php.net/xhprof-0.9.4"
RUN docker-php-pecl-install redis

RUN docker-php-ext-install mysqli iconv exif pdo pdo_mysql opcache bcmath mbstring zip
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd

# Add the extension
RUN echo ";\n">>/usr/local/etc/php/php.ini
RUN echo "extension=xhprof.so" >>/usr/local/etc/php/php.ini

# Add Dot Util
RUN apt-get install -yq graphviz

CMD ["php-fpm"]
