#!/bin/bash
set -e

REMOTE_USER="amisdavc"
REMOTE_HOST="50.87.224.105"
REMOTE_PORT="2222"
REMOTE_PATH="/home2/amisdavc/amis.edu.ph"
ARCHIVE_NAME="id_view_deploy.tar.gz"

echo "=== 1. Bundling ID view file ==="
tar -czf $ARCHIVE_NAME \
    resources/views/pages/id-verification.blade.php

echo "=== 2. Uploading bundle to production server ==="
scp -o StrictHostKeyChecking=no -P $REMOTE_PORT $ARCHIVE_NAME $REMOTE_USER@$REMOTE_HOST:$REMOTE_PATH/

echo "=== 3. Extracting bundle on production and clearing caches ==="
ssh -o StrictHostKeyChecking=no -p $REMOTE_PORT $REMOTE_USER@$REMOTE_HOST "
    cd $REMOTE_PATH && \
    tar -xzf $ARCHIVE_NAME && \
    rm $ARCHIVE_NAME && \
    php artisan view:clear
"

# Clean up local archive
rm -f $ARCHIVE_NAME

echo "=== ID view deployed successfully to AMIS main website! ==="
