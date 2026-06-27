FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
        curl git unzip libpng-dev libxml2-dev libzip-dev libicu-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring xml zip gd intl bcmath opcache \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

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
