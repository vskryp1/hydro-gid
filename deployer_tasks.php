<?php

    namespace Deployer;

    task('artisan:migrate:fresh:seed', function() {
        run('/usr/bin/php {{release_path}}/artisan migrate:fresh --seed --force');
    });

    task('artisan:translate', function() {
        run('/usr/bin/php {{release_path}}/artisan translations:import --replace');
    });

    task('artisan vendor:publish:lfm_public', function() {
        run('/usr/bin/php {{release_path}}/artisan vendor:publish --tag=lfm_public');
    });

    task('artisan:route:trans:cache', function() {
        run('/usr/bin/php {{release_path}}/artisan route:trans:cache');
    });

    task('git:version', function() {
        run('cd {{release_path}} && /usr/bin/git describe --tags > version');
    });

    task('robots:link', function() {
        run('ln -sf {{release_path}}/storage/app/robots.txt {{release_path}}/public/robots.txt');
    });

    task('google:link', function() {
        run('ln -sf {{release_path}}/storage/app/google {{release_path}}/public/google');
    });

    task('supervisor:restart', function() {
        run('sudo /usr/sbin/service supervisor restart');
    });
