<?php

    namespace Tests\Feature\Backend\Users;

    use App\Models\User\Permission;
    use Tests\TestCase;

    class PermissionsTest extends TestCase
    {
        /**
         * testIndex
         *
         * @return void
         */
        public function testIndex()
        {

            $this->be($this->getUser(), 'admin')
                ->get(route('backend.permissions.index'))
                ->assertOk();
        }

        /**
         * testCreate
         *
         * @return void
         */
        public function testCreate()
        {

            $this->be($this->getUser(), 'admin')
                ->get(route('backend.permissions.create'))
                ->assertOk();
        }

        /**
         * testEdit
         *
         * @return void
         */
        public function testEdit()
        {
            $this->be($this->getUser(), 'admin')
                ->get(route('backend.permissions.edit', ['permission' => Permission::first()]))
                ->assertOk();
        }
    }
