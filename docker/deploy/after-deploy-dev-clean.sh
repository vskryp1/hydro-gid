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
php artisan translations:import
php artisan translations:export "*"

chmod -R 777 storage/framework/cache/
###################### After deploy tasks ################

php artisan migrate:fresh --seed

php artisan optimize:clear
php artisan route:trans:cache -d memory_limit=-1
php artisan config:cache
php artisan route:clear

php artisan vendor:publish --provider="UniSharp\LaravelFilemanager\LaravelFilemanagerServiceProvider" --tag="lfm_public" --tag="lfm_view"