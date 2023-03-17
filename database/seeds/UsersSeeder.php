<?php

    use App\Enums\UserType;
    use App\Models\User;
    use Illuminate\Database\Seeder;

    /**
     * Class UsersSeeder
     */
    class UsersSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $admin               = new User;
            $admin->name         = 'Admin';
            $admin->email        = 'admin@artjoker.ua';
            $admin->phone        = null;
            $admin->avatar       = null;
            $admin->active       = true;
            $admin->notification = true;
            $admin->password     = bcrypt('meganote');
            $admin->save();
            $admin->assignRole(UserType::ROLE_SUPER_ADMIN);

            $managerRoma               = new User;
            $managerRoma->name         = 'Roma';
            $managerRoma->email        = 'roma@artjoker.ua';
            $managerRoma->phone        = null;
            $managerRoma->avatar       = null;
            $managerRoma->active       = false;
            $managerRoma->notification = false;
            $managerRoma->password     = bcrypt('meganote');
            $managerRoma->save();
            $managerRoma->assignRole(UserType::ROLE_MANAGER);

            $managerPasha               = new User;
            $managerPasha->name         = 'Pasha';
            $managerPasha->email        = 'pasha@artjoker.ua';
            $managerPasha->phone        = null;
            $managerPasha->avatar       = null;
            $managerPasha->active       = false;
            $managerPasha->notification = false;
            $managerPasha->password     = bcrypt('meganote');
            $managerPasha->save();
            $managerPasha->assignRole(UserType::ROLE_MANAGER);

            $managerSasha               = new User;
            $managerSasha->name         = 'Sasha';
            $managerSasha->email        = 'sasha@artjoker.ua';
            $managerSasha->phone        = null;
            $managerSasha->avatar       = null;
            $managerSasha->active       = false;
            $managerSasha->notification = false;
            $managerSasha->password     = bcrypt('meganote');
            $managerSasha->save();
            $managerSasha->assignRole(UserType::ROLE_MANAGER);
        }
    }
