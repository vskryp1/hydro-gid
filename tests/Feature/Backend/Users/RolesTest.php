<?php

    namespace Tests\Feature\Backend\Users;

    use App\Models\Role;
    use Tests\TestCase;

    class RolesTest extends TestCase
    {
        /**
         * testIndex
         *
         * @return void
         */
        public function testIndex()
        {
            $this->be($this->getUser(), 'admin')
                ->get(route('backend.roles.index'))
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
                ->get(route('backend.roles.create'))
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
                ->get(route('backend.roles.edit', ['role' => Role::first()]))
                ->assertOk();
        }
    }
