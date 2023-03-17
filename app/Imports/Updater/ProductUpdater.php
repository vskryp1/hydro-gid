<?php

    namespace App\Imports\Updater;

    class ProductUpdater extends RowsUpdater
    {
        public function active(string $value = null): void
        {
            $this->model->active = (bool)$value;
        }

        public function pages(string $value): void
        {
            $value = $value ? json_decode($value) : [];

            $this->model->pages()->sync($value);
        }

        public function warranties(string $value = null): void
        {
            $value = $value ? json_decode($value) : [];

            $this->model->warranties()->sync($value);
        }

        public function filter_values(string $value): void
        {
            $value = $value ? json_decode($value) : [];

            $this->model->filter_values()->sync($value);
        }

        public function productRelations(string $value): void
        {
            $value = $value ? json_decode($value) : [];

            $this->model->productRelations()->sync($value);
        }
    }
