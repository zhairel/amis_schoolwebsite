#!/bin/bash
set -e

REMOTE_USER="amisdavc"
REMOTE_HOST="50.87.224.105"
REMOTE_PORT="2222"
REMOTE_PATH="/home2/amisdavc/amis.edu.ph"
ARCHIVE_NAME="website_deploy.tar.gz"
COMPOSER_BIN="php /home/tatsuya/Projects/AMIS/composer.phar"

echo "1. Building assets locally..."
npm run build

echo "2. Preparing PHP vendor dependencies locally..."
$COMPOSER_BIN install --no-dev --optimize-autoloader

echo "3. Swapping configuration to production..."
cp .env .env.local
cp .env.production .env

echo "4. Bundling application files (including vendor)..."
tar -czf $ARCHIVE_NAME \
    app \
    bootstrap \
    config \
    database \
    public \
    resources \
    routes \
    storage \
    vendor \
    .env \
    .htaccess \
    artisan \
    composer.json \
    composer.lock \
    package.json \
    vite.config.js

# Restore local config immediately
cp .env.local .env
rm -f .env.local

echo "5. Uploading bundle to production server..."
scp -o StrictHostKeyChecking=no -P $REMOTE_PORT $ARCHIVE_NAME $REMOTE_USER@$REMOTE_HOST:$REMOTE_PATH/

echo "6. Extracting bundle on production and running Artisan commands..."
ssh -o StrictHostKeyChecking=no -p $REMOTE_PORT $REMOTE_USER@$REMOTE_HOST "
    cd $REMOTE_PATH && \
    tar -xzf $ARCHIVE_NAME && \
    rm $ARCHIVE_NAME && \
    php artisan migrate --force && \
    php artisan db:seed --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache
"

# Clean up local archive
rm -f $ARCHIVE_NAME

echo "7. Restoring local dev composer packages..."
$COMPOSER_BIN install

echo "Successfully deployed Al Munawwara Islamic School Website to production!"
