<?php

    use App\Models\Client\Address;
    use App\Models\Client\Client;
    use Illuminate\Database\Seeder;

    /**
     * Class ClientsSeeder
     */
    class ClientsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            factory(Client::class, rand(5, 10))
                ->create()
                ->each(
                    function(Client $user) {
                        factory(Address::class, rand(1, 2))
                            ->create(['client_id' => $user->id]);
                    }
                );
        }
    }
