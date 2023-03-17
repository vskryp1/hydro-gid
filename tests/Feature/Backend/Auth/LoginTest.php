<?php

    namespace Tests\Feature\Backend\Auth;

    use Tests\TestCase;

    class LoginTest extends TestCase
    {
        /**
         * testLogin
         *
         * @return void
         */
        public function testLogin()
        {
            $this->get(route('backend.login'))
                ->assertOk();
        }

        /**
         * testLoginPost
         *
         * @return void
         */
        public function testLoginPost()
        {
            $this->withoutMiddleware();

            $this->post(route('backend.login'), [
                'email'    => 'admin@artjoker.ua',
                'password' => 'meganote',
            ]);

            $this->assertAuthenticated('admin');
        }

        /**
         * testLogout
         *
         * @return void
         */
        public function testLogout()
        {
            $this->get(route('backend.logout'))
                ->assertStatus(302);
        }

        /**
         * testLoginFailureData
         *
         * @return void
         */
        public function testLoginFailureData()
        {
            $this->withoutMiddleware();

            $this->post(route('backend.login'), [
                'email'    => 'sancho@artjoker.ua',
                'password' => 'somepass',
            ])->assertStatus(302);
        }
    }
