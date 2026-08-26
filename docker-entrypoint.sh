#!/bin/bash
set -e

if [ ! -f /var/www/html/index.php ]; then
    echo "ERROR: index.php not found"
    exit 1
fi

echo "Installing database schema..."
php /var/www/html/database/install.php || echo "Schema install skipped or already done."

exec "$@"
