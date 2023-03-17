<?php

    namespace Tests;

    use App\Enums\UserType;
    use App\Models\User;
    use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
    use PHPUnit\Framework\Assert as PHPUnit;
    use Spatie\Permission\PermissionRegistrar;

    /**
     * Class TestCase
     *
     * @package Tests
     */
    abstract class TestCase extends BaseTestCase
    {
        use CreatesApplication;

        /**
         * @return void
         * @throws \Illuminate\Contracts\Container\BindingResolutionException
         */
        public function setUp(): void
        {
            parent::setUp();

            $this->app->make(PermissionRegistrar::class)->registerPermissions();
        }

        /**
         * @return void
         */
        public function assertSessionHasNoErrors(): void
        {
            PHPUnit::assertFalse(
                session()->exists('errors'),
                'Error:' . session()->get('errors')
            );
        }

        /**
         * @param        $response
         * @param  bool  $withRedirect
         *
         * @return void
         */
        public function assertDefault($response, bool $withRedirect = true): void
        {
            $this->assertSessionHasNoErrors();

            $response->assertStatus(302);

            if ($withRedirect) {
                $response->assertRedirect($this->url);
            }

            $response->assertSessionHas('success');
        }

        protected function getUser()
        {
            return User::role(UserType::ROLE_SUPER_ADMIN)->first();
        }
    }
