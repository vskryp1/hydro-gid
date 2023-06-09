<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\StorageLinkCommand;

class CustomStorageLinkCommand extends StorageLinkCommand
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symbolic link from "public/a" to "storage/app/public"';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (file_exists(public_path('a'))) {
            return $this->error('The "public/a" directory already exists.');
        }
        $this->laravel->make('files')->link(
            storage_path('app/public'), public_path('a')
        );
        $this->info('The [public/a] directory has been linked.');
    }
}