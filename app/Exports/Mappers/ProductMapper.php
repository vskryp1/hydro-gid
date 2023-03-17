<?php

    namespace App\Exports\Mappers;

    class ProductMapper extends Mapper
    {
        public function active()
        {
            return (int)$this->model->active;
        }

        public function rating_calculate()
        {
            return (int)$this->model->rating_calculate;
        }

        public function filter_values()
        {
            return $this->model->filter_values->pluck('id')->toArray();
        }

        public function pages()
        {
            return $this->model->pages->pluck('id')->toArray();
        }

        public function warranties()
        {
            return $this->model->warranties->pluck('id')->toArray();
        }

        public function productRelations()
        {
            return $this->model->productRelations->pluck('id')->toArray();
        }
    }
