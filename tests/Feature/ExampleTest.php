<?php

    namespace Tests\Feature;

    use Tests\TestCase;

    /**
     * Class ExampleTest
     *
     * @package Tests\Feature
     */
    class ExampleTest extends TestCase
    {
        /**
         * A basic test example.
         *
         * @return void
         */
        public function testBasicTest()
        {
            $response = $this->get('/' . env('BACKEND_URI') . '/login');

            $response->assertStatus(200);
        }
    }
