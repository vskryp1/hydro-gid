<?php

    namespace App\Models;

    use App\Enums\UserType;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Relations\MorphToMany;
    use Spatie\Permission\Contracts\Role as RoleContract;
    use Spatie\Permission\Exceptions\RoleDoesNotExist;
    use Spatie\Permission\Models\Role as RoleModel;
    use Spatie\Permission\Guard;

    class Role extends RoleModel
    {
        public static function findByName(string $name, $guardName = null): RoleContract
        {
            $guardName = $guardName ?? Guard::getDefaultName(static::class);

            $role = static::where('name', 'LIKE', '%' . $name . '%')
                ->whereIn('guard_name', [$guardName, 'web'])
                ->first();

            if (! $role) {
                throw RoleDoesNotExist::named($name);
            }

            return $role;
        }

        public function clients(): MorphToMany
        {
            return $this->morphedByMany(
                getModelForGuard('web'),
                'model',
                config('permission.table_names.model_has_roles'),
                'role_id',
                config('permission.column_names.model_morph_key')
            );
        }

        public function scopeOnlyActive(Builder $builder)
        {
            return $builder->where('active', 1);
        }

        public function scopeOnlyAdmin(Builder $builder)
        {
            return $builder->where('guard_name', 'admin');
        }

        public function isAdmin()
        {
            return $this->name === UserType::ROLE_SUPER_ADMIN;
        }

        public function isManager()
        {
            return $this->name === UserType::ROLE_MANAGER;
        }

        public function isEditor()
        {
            return $this->name === UserType::ROLE_EDITOR;
        }

        public function isSimpleUser()
        {
            return $this->name === UserType::ROLE_SIMPLE_USER;
        }

        public function isLegalEntity()
        {
            return $this->name === UserType::ROLE_LEGAL_ENTITY;
        }

        public function isAdminGuardName()
        {
            return $this->getOriginal('guard_name') === 'admin';
        }
    }
