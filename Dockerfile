FROM php:8.2-apache

# ติดตั้ง Extension สำหรับเชื่อมต่อ MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# เปิดใช้งาน Apache mod_rewrite
RUN a2enmod rewrite

# เปลี่ยน Document Root ของ Apache ให้ชี้ไปที่โฟลเดอร์ public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
