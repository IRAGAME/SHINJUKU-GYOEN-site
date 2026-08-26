#!/bin/bash
set -e

if [ ! -f /var/www/html/index.php ]; then
    echo "ERROR: index.php not found"
    exit 1
fi

exec "$@"
