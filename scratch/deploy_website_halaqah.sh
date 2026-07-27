#!/bin/bash
set -e

REMOTE_USER="amisdavc"
REMOTE_HOST="50.87.224.105"
REMOTE_PORT="2222"
REMOTE_PATH="/home2/amisdavc/amis.edu.ph"
ARCHIVE_NAME="website_halaqah_deploy.tar.gz"

echo "Copying views to fallback folders..."
cp resources/views/isal/halaqah.blade.php resources/views/academics/halaqah.blade.php || true

echo "Bundling updated website controllers, models, migrations, and view files..."
tar -czf $ARCHIVE_NAME \
    app/Http/Controllers/ContactController.php \
    app/Http/Controllers/Admin/HalaqahRegistrationController.php \
    app/Models/HalaqahRegistration.php \
    database/migrations/2026_07_05_094500_create_halaqah_registrations_table.php \
    database/migrations/2026_07_26_000000_update_halaqah_registrations_table.php \
    database/migrations/2026_07_27_000000_ensure_address_in_halaqah_registrations_table.php \
    resources/views/isal/halaqah.blade.php \
    resources/views/isal/halaqah_parents.blade.php \
    resources/views/admin/halaqah_registrations/index.blade.php

echo "Uploading bundle to website production server..."
scp -o StrictHostKeyChecking=no -P $REMOTE_PORT $ARCHIVE_NAME $REMOTE_USER@$REMOTE_HOST:$REMOTE_PATH/

echo "Extracting bundle on production and running migrations..."
ssh -o StrictHostKeyChecking=no -p $REMOTE_PORT $REMOTE_USER@$REMOTE_HOST "cd $REMOTE_PATH && tar -xzf $ARCHIVE_NAME && rm $ARCHIVE_NAME && php artisan migrate --force && php artisan config:clear && php artisan cache:clear && php artisan view:clear"

echo "Clean up local temporary file copy..."
rm -f resources/views/academics/halaqah.blade.php

echo "Successfully deployed Halaqah Parents & Address updates to amis.edu.ph production!"
