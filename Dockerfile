FROM php:8.4-cli

# install-php-extensions: tüm OS bağımlılıklarını otomatik halleder (libsqlite3-dev dahil)
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo pdo_sqlite mbstring xml zip gd intl bcmath fileinfo opcache

# Composer: Docker Hub yerine doğrudan indir
ADD https://getcomposer.org/download/latest-stable/composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

WORKDIR /app

COPY . .

RUN composer update --no-dev --optimize-autoloader \
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
  php artisan tinker --execute=\"DB::table('users')->updateOrInsert(['email' => env('ADMIN_EMAIL','sertac@hotmail.com')], ['name' => 'Sertaç Apanay', 'password' => bcrypt(env('ADMIN_PASSWORD','changeme')), 'email_verified_at' => now(), 'updated_at' => now(), 'created_at' => now()]);\" && \
  php artisan storage:link && \
  php artisan optimize && \
  php artisan serve --host=0.0.0.0 --port=\${PORT:-8080}"
