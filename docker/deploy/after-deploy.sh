#!/bin/bash

###################### After deploy script ###############

WORK_DIR='/app'

cd $WORK_DIR || return 1

################### Fix storage permissions ###############

# Create dirs if not exist

chown -R ${FPM_USER}:${FPM_USER} storage

if  [ ! -d storage/framework/sessions ]; then
    mkdir -p storage/framework/sessions
fi

if  [ ! -d storage/framework/views ]; then
    mkdir -p storage/framework/views
fi

if  [ ! -d storage/framework/cache ]; then
    mkdir -p storage/framework/cache
fi

chown -R ${FPM_USER}:${FPM_USER} storage

if [ -L public/storage ]; then unlink public/storage; fi

php artisan storage:link

if [ ! -L /app/public/sitemap.xml ]; then
  ln -s /app/storage/app/public/sitemap.xml /app/public/sitemap.xml
fi

if [ ! -L /app/public/sitemap-image.xml ]; then
  ln -s /app/storage/app/public/sitemap-image.xml /app/public/sitemap-image.xml
fi

if [ ! -L /app/public/robots.txt ]; then
  ln -s /app/storage/app/public/robots.txt /app/public/robots.txt
fi

if [ ! -L /app/public/merchant_feed.xml ]; then
  ln -s /app/storage/app/public/merchant_feed.xml /app/public/merchant_feed.xml
fi

if [ ! -L /app/public/facebook_feed.xml ]; then
  ln -s /app/storage/app/public/facebook_feed.xml /app/public/facebook_feed.xml
fi

###################### After deploy tasks ################

php artisan migrate --force

php artisan vendor:publish --provider="UniSharp\LaravelFilemanager\LaravelFilemanagerServiceProvider" --tag="lfm_public" --tag="lfm_view" --force
php artisan translations:import
php artisan translations:export "*"

php artisan optimize:clear
php artisan route:trans:cache -d memory_limit=-1
php artisan config:cache
php artisan route:clear