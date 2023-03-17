<?php

    namespace App\Observers;

    use App\Enums\UserType;
    use App\Models\Client\Client;

    class ClientObserver
    {
        /**
         * Handle the client "created" event.
         *
         * @param  \App\Models\Client\Client  $user
         *
         * @return void
         */
        public function created(Client $user)
        {
            $user->assignRole(static::getUserRole($user));
        }

        /**
         * Handle the client "updated" event.
         *
         * @param  \App\Models\Client\Client  $user
         *
         * @return void
         */
        public function updated(Client $user)
        {
            $user->assignRole(static::getUserRole($user));
        }

        /**
         * Handle the client "deleted" event.
         *
         * @param  \App\Models\Client\Client  $user
         *
         * @return void
         */
        public function deleted(Client $user)
        {
            $user->removeRole(static::getUserRole($user));
        }

        /**
         * Handle the client "restored" event.
         *
         * @param  \App\Models\Client\Client  $user
         *
         * @return void
         */
        public function restored(Client $user)
        {
            $user->assignRole(static::getUserRole($user));
        }

        /**
         * Handle the client "force deleted" event.
         *
         * @param  \App\Models\Client\Client  $user
         *
         * @return void
         */
        public function forceDeleted(Client $user)
        {
            $user->removeRole(static::getUserRole($user));
        }

        private static function getUserRole(Client $user)
        {
            return $user->is_legal_entity ? UserType::ROLE_LEGAL_ENTITY : UserType::ROLE_SIMPLE_USER;
        }
    }
