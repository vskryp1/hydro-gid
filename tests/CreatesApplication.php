<?php

    namespace Tests;

    use Illuminate\Contracts\Console\Kernel;
    use Illuminate\Support\Facades\Hash;

    /**
     * Trait CreatesApplication
     *
     * @package Tests
     */
    trait CreatesApplication
    {
        /**
         * Creates the application.
         *
         * @return \Illuminate\Foundation\Application
         */
        public function createApplication()
        {
            $app = require __DIR__ . '/../bootstrap/app.php';
            $app->make(Kernel::class)->bootstrap();

            Hash::setRounds(4);

            return $app;
        }
    }
