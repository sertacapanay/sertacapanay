FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libxml2-dev libzip-dev libicu-dev libonig-dev libsqlite3-dev \
    curl zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo pdo_sqlite mbstring xml zip gd intl bcmath fileinfo \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

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
  php artisan migrate --force && \
  php artisan db:seed --force && \
  php artisan storage:link && \
  php artisan serve --host=0.0.0.0 --port=\${PORT:-8000}"
