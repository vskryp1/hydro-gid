<?php

    namespace App\Models\User;

    use Spatie\Permission\Models\Permission as PermissionVendor;

    class Permission extends PermissionVendor
    {
        public $guard_name = 'admin';

        public $keyType = 'string';
    }
