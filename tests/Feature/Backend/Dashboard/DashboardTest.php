<?php

    namespace Tests\Feature\Backend\Dashboard;

    use Tests\TestCase;

    class DashboardTest extends TestCase
    {
        /**
         * testIndex
         *
         * @return void
         */
        public function testIndex()
        {
            $this->be($this->getUser(), 'admin')
                ->get(route('backend.dashboard'))
                ->assertOk();
        }
    }
