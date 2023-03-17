<?php

    namespace Tests\Feature\Backend\Pages;

    use App\Models\Page\PageTemplate;
    use Tests\TestCase;

    class TemplatesTest extends TestCase
    {
        /**
         * testIndex
         *
         * @return void
         */
        public function testIndex()
        {
            $this->be($this->getUser(), 'admin')
                ->get(route('backend.templates.index'))
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
                ->get(route('backend.templates.create'))
                ->assertOk();
        }

        /**
         * testEdit
         *
         * @return void
         */
        public function testEdit()
        {
            $template = factory(PageTemplate::class)->create();

            $this->be($this->getUser(), 'admin')
                ->get(route('backend.templates.edit', ['template' => $template]))
                ->assertOk();
        }
    }
