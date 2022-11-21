FROM php:7-apache

RUN apt-get update && apt-get install -y zlib1g-dev libpng-dev libonig-dev ufw
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql 
RUN docker-php-ext-install gd
#block các ip không phải local trong file config
COPY apache.conf /etc/apache2/sites-available/000-default.conf



# Cấu hình server chỉ mở inbound truy cập web trên port 80, chặn toàn bộ outbound.
RUN ufw default deny incoming
RUN ufw default deny outgoing
RUN ufw allow 3306
RUN ufw allow 80/tcp

# web001 configuration
RUN mkdir -p /web/user1
WORKDIR /web/user1
COPY ./web001 .
RUN chmod 777 -R /web/user1
RUN useradd user1 -G www-data
RUN chown -R user1:www-data /web/user1

# web001 configuration
RUN mkdir -p /web/user2
WORKDIR /web/user2
COPY ./web002 .
RUN chmod 777 -R /web/user2
RUN useradd user2 -G www-data
RUN chown -R user2:www-data /web/user2

RUN a2enmod rewrite