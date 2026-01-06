#!/bin/bash
cd /mnt/c/Users/Elizabeth/costaricatrippackages || exit 1

echo "--- LAST 200 LINES OF laravel.log ---"
tail -n 200 storage/logs/laravel.log || true

echo "--- HOTELS ---"
echo "SELECT id,name,slug,created_at FROM hotels ORDER BY id DESC LIMIT 10;" | mysql -u laravel_user -psecret costaricatrippackages

echo "--- HOTEL_AMENITIES ---"
echo "SELECT id,hotel_id,name,icon,created_at FROM hotel_amenities ORDER BY id DESC LIMIT 10;" | mysql -u laravel_user -psecret costaricatrippackages
