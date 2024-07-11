<?php

    namespace App\Console;

    use App\Helpers\BackupHelper;
    use App\Jobs\GetCitiesNPJob;
    use Illuminate\Console\Scheduling\Schedule;
    use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

    class Kernel extends ConsoleKernel
    {
        /**
         * The Artisan commands provided by your application.
         *
         * @var array
         */
        protected $commands = [];

        /**
         * Define the application's command schedule.
         *
         * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
         *
         * @return void
         */
        protected function schedule(Schedule $schedule)
        {
            //Every day get actual course
//            $schedule->command('stocks:activate')->dailyAt(config('app.stock_price_time_calc'));
//            $schedule->command('stocks:deactivate')->dailyAt(config('app.stock_price_time_calc'));
//            $schedule->command('currencies:course')->dailyAt(config('app.currencies_get_time'));
//            $schedule->command('clear:temp')->dailyAt(config('app.currencies_get_time'));
	        // update product status
//            $schedule->command('products:status:update')->dailyAt(config('app.products_availability_update_time'));

            // generate Merchant Feed
//            $schedule->command('merchant:feed')->dailyAt(config('app.merchant_feed_generate'));

            // generate Facebook Feed
//            $schedule->command('facebook:feed')->dailyAt(config('app.facebook_feed_generate'));

            // generate sitemap image
            $schedule->command('sitemap:image')->dailyAt(config('app.sitemap_image_generate'));

            // generate sitemap 
            $schedule->command('sitemap:')->dailyAt(config('app.sitemap_image_generate'));
//            $schedule->command('sitemap:')->dailyAt('8:50');

            //update new post cities
            $schedule->job(new GetCitiesNPJob(config('app.locale')))->dailyAt(config('app.np_get_time'));

            //make daily backup
            $schedule->call(function() {
                if (\Setting::get('backups.active', false)) {
                    \Artisan::call('backup:run');
                    BackupHelper::clearOldBackup();
                }
            })->dailyAt(config('backup.auto_backup_time'));//\Setting::get('backups.time', '1:00')

            $schedule->command('queue:work --tries=3 --timeout=300 --once')
	        ->cron('*/2 * * * *')
                ->withoutOverlapping(5);

            $schedule->command('queue:work --tries=3 --timeout=300 --once --queue=mail,mail2')
	        ->cron('*/2 * * * *')
                ->withoutOverlapping(5);

        }

        /**
         * Register the commands for the application.
         *
         * @return void
         */
        protected function commands()
        {
            $this->load(__DIR__ . '/Commands');

            require base_path('routes/console.php');
        }
    }
