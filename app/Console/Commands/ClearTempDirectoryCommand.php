<?php

    namespace App\Console\Commands;

    use App\Models\Product\Product;
    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\Storage;

    class ClearTempDirectoryCommand extends Command
    {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'clear:temp';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Clear temp directory for products';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function handle()
        {
            Storage::deleteDirectory('public/' . Product::GALLERY_PATH . 'tmp');
        }
    }
