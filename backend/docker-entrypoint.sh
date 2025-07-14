#!/bin/sh

# Cài đặt vendor (nếu cần)
composer install

# Tạo app key (bỏ qua kiểm tra .env)
php artisan key:generate --force

# Chạy migrate không kiểm tra
php artisan migrate --force

php artisan reverb:start --host=127.0.0.1 --port=9000

# Khởi động server Laravel
php artisan serve --host=0.0.0.0 --port=8000
