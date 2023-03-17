<?php

    use App\Enums\UserType;
    use App\Models\Role;
    use App\Models\User\Permission;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    /**
     * Class RolesSeeder
     */
    class RolesSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         * @throws \Throwable
         */
        public function run(): void
        {
            // Reset cached roles and permissions
            app()['cache']->forget('spatie.permission.cache');

            DB::transaction(function() {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                Role::truncate();
                DB::statement('TRUNCATE TABLE `role_has_permissions`');
                Permission::truncate();

                Permission::create(['name' => 'add clients']);
                Permission::create(['name' => 'edit clients']);
                Permission::create(['name' => 'delete clients']);
                Permission::create(['name' => 'list clients']);

                Permission::create(['name' => 'add admins']);
                Permission::create(['name' => 'edit admins']);
                Permission::create(['name' => 'delete admins']);
                Permission::create(['name' => 'list admins']);

                Permission::create(['name' => 'add permissions']);
                Permission::create(['name' => 'edit permissions']);
                Permission::create(['name' => 'delete permissions']);
                Permission::create(['name' => 'list permissions']);

                Permission::create(['name' => 'add roles']);
                Permission::create(['name' => 'edit roles']);
                Permission::create(['name' => 'delete roles']);
                Permission::create(['name' => 'list roles']);

                Permission::create(['name' => 'add products']);
                Permission::create(['name' => 'edit products']);
                Permission::create(['name' => 'delete products']);
                Permission::create(['name' => 'list products']);

                Permission::create(['name' => 'add product statuses']);
                Permission::create(['name' => 'edit product statuses']);
                Permission::create(['name' => 'delete product statuses']);
                Permission::create(['name' => 'list product statuses']);

                Permission::create(['name' => 'add filters']);
                Permission::create(['name' => 'edit filters']);
                Permission::create(['name' => 'delete filters']);
                Permission::create(['name' => 'list filters']);

                Permission::create(['name' => 'add pages']);
                Permission::create(['name' => 'edit pages']);
                Permission::create(['name' => 'delete pages']);
                Permission::create(['name' => 'list pages']);

                Permission::create(['name' => 'add page templates']);
                Permission::create(['name' => 'edit page templates']);
                Permission::create(['name' => 'delete page templates']);
                Permission::create(['name' => 'list page templates']);

                Permission::create(['name' => 'add orders']);
                Permission::create(['name' => 'edit orders']);
                Permission::create(['name' => 'delete orders']);
                Permission::create(['name' => 'list orders']);
                Permission::create(['name' => 'list all orders']);
                Permission::create(['name' => 'export orders']);
                Permission::create(['name' => 'add order statuses']);
                Permission::create(['name' => 'edit order statuses']);
                Permission::create(['name' => 'delete order statuses']);
                Permission::create(['name' => 'list order statuses']);

                Permission::create(['name' => 'add payments']);
                Permission::create(['name' => 'edit payments']);
                Permission::create(['name' => 'delete payments']);
                Permission::create(['name' => 'list payments']);

                Permission::create(['name' => 'add deliveries']);
                Permission::create(['name' => 'edit deliveries']);
                Permission::create(['name' => 'delete deliveries']);
                Permission::create(['name' => 'list deliveries']);

                Permission::create(['name' => 'list promocodes']);
                Permission::create(['name' => 'edit promocodes']);
                Permission::create(['name' => 'add promocodes']);
                Permission::create(['name' => 'delete promocodes']);

                Permission::create(['name' => 'add seo redirects']);
                Permission::create(['name' => 'edit seo redirects']);
                Permission::create(['name' => 'delete seo redirects']);
                Permission::create(['name' => 'list seo redirects']);

                Permission::create(['name' => 'add faq']);
                Permission::create(['name' => 'edit faq']);
                Permission::create(['name' => 'delete faq']);
                Permission::create(['name' => 'list faq']);

                Permission::create(['name' => 'add seo sitemap']);
                Permission::create(['name' => 'edit seo sitemap']);
                Permission::create(['name' => 'delete seo sitemap']);
                Permission::create(['name' => 'list seo sitemap']);

                Permission::create(['name' => 'add seo meta']);
                Permission::create(['name' => 'edit seo meta']);
                Permission::create(['name' => 'delete seo meta']);
                Permission::create(['name' => 'list seo meta']);

                Permission::create(['name' => 'edit seo scripts']);
                Permission::create(['name' => 'list seo scripts']);

                Permission::create(['name' => 'edit seo robots']);
                Permission::create(['name' => 'list seo robots']);

                Permission::create(['name' => 'list mail']);
                Permission::create(['name' => 'edit mail']);
                Permission::create(['name' => 'delete mail']);
                Permission::create(['name' => 'add mail']);

                Permission::create(['name' => 'list main template']);

                Permission::create(['name' => 'list subscribers']);
                Permission::create(['name' => 'edit subscribers']);
                Permission::create(['name' => 'delete subscribers']);

                Permission::create(['name' => 'start newsletter']);
                Permission::create(['name' => 'list newsletter']);

                Permission::create(['name' => 'list currencies']);
                Permission::create(['name' => 'add currencies']);
                Permission::create(['name' => 'edit currencies']);
                Permission::create(['name' => 'delete currencies']);

                Permission::create(['name' => 'actual courses']);

                Permission::create(['name' => 'manage languages']);

                Permission::create(['name' => 'list translations']);
                Permission::create(['name' => 'manage translations']);
                Permission::create(['name' => 'publish translations']);

                Permission::create(['name' => 'list regions']);
                Permission::create(['name' => 'edit regions']);
                Permission::create(['name' => 'delete regions']);
                Permission::create(['name' => 'add regions']);

                Permission::create(['name' => 'list import export clients']);
                Permission::create(['name' => 'list import export products']);
                Permission::create(['name' => 'list import export orders']);

                Permission::create(['name' => 'list sliders']);
                Permission::create(['name' => 'edit sliders']);
                Permission::create(['name' => 'delete sliders']);
                Permission::create(['name' => 'add sliders']);

                Permission::create(['name' => 'list menus']);
                Permission::create(['name' => 'edit menus']);
                Permission::create(['name' => 'delete menus']);
                Permission::create(['name' => 'add menus']);

                Permission::create(['name' => 'list settings']);
                Permission::create(['name' => 'edit settings']);
                Permission::create(['name' => 'delete settings']);
                Permission::create(['name' => 'add settings']);

                Permission::create(['name' => 'list reviews']);
                Permission::create(['name' => 'edit reviews']);
                Permission::create(['name' => 'delete reviews']);
                Permission::create(['name' => 'add reviews']);

                Permission::create(['name' => 'list service order']);
                Permission::create(['name' => 'edit service order']);
                Permission::create(['name' => 'delete service order']);
                Permission::create(['name' => 'add service order']);

                Permission::create(['name' => 'list stocks']);
                Permission::create(['name' => 'edit stocks']);
                Permission::create(['name' => 'delete stocks']);
                Permission::create(['name' => 'add stocks']);

                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            });

            $roleSuperadmin  = Role::create([
                'name'       => UserType::ROLE_SUPER_ADMIN,
                'guard_name' => 'admin',
                'active'     => true,
            ]);
            $roleManager     = Role::create([
                'name'       => UserType::ROLE_MANAGER,
                'guard_name' => 'admin',
                'active'     => true,
            ]);
            $roleEditor      = Role::create([
                'name'       => UserType::ROLE_EDITOR,
                'guard_name' => 'admin',
                'active'     => true,
            ]);
            $roleSimpleUser  = Role::create([
                'name'       => UserType::ROLE_SIMPLE_USER,
                'guard_name' => 'web',
                'active'     => true,
            ]);
            $roleLegalEntity = Role::create([
                'name'       => UserType::ROLE_LEGAL_ENTITY,
                'guard_name' => 'web',
                'active'     => true,
            ]);

            $roleSuperadmin->givePermissionTo(Permission::all());
            $roleManager->givePermissionTo([
                'add orders',
                'edit orders',
                'delete orders',
                'list orders',
                'export orders',
            ]);

            Permission::create(['name' => 'list orders buy click','guard_name' => 'admin']);

            Role::findByName(UserType::ROLE_MANAGER, 'admin')
                ->givePermissionTo('list orders buy click');
            Role::findByName(UserType::ROLE_SUPER_ADMIN, 'admin')
                ->givePermissionTo('list orders buy click');
        }
    }
