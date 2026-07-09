#!/bin/bash
set -e

REMOTE_USER="amisdavc"
REMOTE_HOST="50.87.224.105"
REMOTE_PORT="2222"
REMOTE_PATH="/home2/amisdavc/amis.edu.ph"
ARCHIVE_NAME="qr_fix_deploy.tar.gz"

echo "=== 1. Bundling QR fix files ==="
tar -czf $ARCHIVE_NAME \
    app/Http/Controllers/PublicVerificationController.php \
    app/Http/Controllers/IdVerificationController.php

echo "=== 2. Uploading bundle to production server ==="
scp -o StrictHostKeyChecking=no -P $REMOTE_PORT $ARCHIVE_NAME $REMOTE_USER@$REMOTE_HOST:$REMOTE_PATH/

echo "=== 3. Extracting bundle on production and clearing caches ==="
ssh -o StrictHostKeyChecking=no -p $REMOTE_PORT $REMOTE_USER@$REMOTE_HOST "
    cd $REMOTE_PATH && \
    tar -xzf $ARCHIVE_NAME && \
    rm $ARCHIVE_NAME && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear
"

# Clean up local archive
rm -f $ARCHIVE_NAME

echo "=== QR fix deployed successfully to AMIS main website! ==="
