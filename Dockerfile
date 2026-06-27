FROM dunglas/frankenphp:latest-php8.4-alpine

# Gerekli kütüphaneler + PHP eklentileri + Composer
RUN apk add --no-cache curl \
    && install-php-extensions \
        pdo pdo_sqlite mbstring xml zip gd intl bcmath fileinfo opcache \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD sh -c "\
  mkdir -p storage/framework/views storage/framework/cache/data storage/framework/sessions storage/logs storage/app/public storage/database database && \
  chmod -R 775 storage bootstrap/cache && \
  KEY_FILE=storage/.app_key && \
  if [ ! -f \"\$KEY_FILE\" ]; then \
    php -r \"echo 'base64:'.base64_encode(random_bytes(32));\" > \"\$KEY_FILE\"; \
  fi && \
  export APP_KEY=\$(cat \"\$KEY_FILE\") && \
  DB_PATH=\${DB_DATABASE:-/app/storage/database/database.sqlite} && \
  mkdir -p \$(dirname \"\$DB_PATH\") && \
  export DB_DATABASE=\$DB_PATH && \
  php artisan migrate --force && \
  php artisan db:seed --force && \
  php artisan storage:link && \
  php artisan optimize && \
  SERVER_NAME=\":${PORT:-8000}\" frankenphp php-server --root public"
