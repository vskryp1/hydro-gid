<?php

    namespace Tests\Feature\Backend\Users;

    use App\Models\User;
    use Tests\TestCase;

    class UsersTest extends TestCase
    {
        /**
         * testIndex
         *
         * @return void
         */
        public function testIndex()
        {

            $this->be($this->getUser(), 'admin')
                ->get(route('backend.users.index'))
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
                ->get(route('backend.users.create'))
                ->assertOk();
        }

        /**
         * testEdit
         *
         * @return void
         */
        public function testEdit()
        {
            $user = factory(User::class)->create();

            $this->be($this->getUser(), 'admin')
                ->get(route('backend.users.edit', ['user' => $user]))
                ->assertOk();
        }
    }
