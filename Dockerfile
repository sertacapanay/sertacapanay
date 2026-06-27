FROM php:8.4-cli-alpine

RUN apk add --no-cache curl libpng-dev libxml2-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_sqlite mbstring xml gd intl bcmath zip opcache \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD sh -c "\
  mkdir -p storage/framework/views storage/framework/cache/data storage/framework/sessions storage/logs storage/app/public storage/database && \
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
  php artisan serve --host=0.0.0.0 --port=\${PORT:-8080}"
