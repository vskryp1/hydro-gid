<?php

    use Illuminate\Database\Seeder;

    /**
     * Class SeoRobotsSeeds
     */
    class SeoRobotsSeeds extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            Storage::disk('public_files')->put('robots.txt', "User-agent: *\nDisallow: /");
        }
    }
