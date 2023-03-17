<?php

    use App\Enums\UserType;
    use Illuminate\Support\Facades\Artisan;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    class AddNewPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed', ['--class' => 'RolesSeeder']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::findByName(UserType::ROLE_MANAGER, 'admin')
            ->revokePermissionTo('list orders buy click');
        Role::findByName(UserType::ROLE_SUPER_ADMIN, 'admin')
            ->revokePermissionTo('list orders buy click');
    }
}
