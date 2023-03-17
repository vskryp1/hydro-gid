<?php

    namespace Tests\Feature\Backend\Pages;

    use App\Models\Page\Page;
    use Tests\TestCase;

    class PagesTest extends TestCase
    {
        /**
         * testIndex
         *
         * @return void
         */
        public function testIndex()
        {
            $this->be($this->getUser(), 'admin')
                ->get(route('backend.pages.index'))
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
                ->get(route('backend.pages.create'))
                ->assertOk();
        }

        /**
         * testEdit
         *
         * @return void
         */
        public function testEdit()
        {
            $page = factory(Page::class)->create();

            $this->be($this->getUser(), 'admin')
                ->get(route('backend.pages.edit', ['page' => $page]))
                ->assertOk();
        }
    }
