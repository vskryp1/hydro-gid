<?php

    namespace App\QueryFilters;

    class ProductsFilter extends QueryFilter
    {
        public function categories($value): void
        {
            $this->builder->inCategories($value);
        }

        public function statuses($value): void
        {
            $this->builder->whereIn('product_status_id', $value);
        }

        public function warranties($value): void
        {
            $this->builder->whereHas(
                'warranties',
                function($query) use ($value) {
                    $query->whereIn('id', $value);
                }
            );
        }

        public function currencies($value): void
        {
            $this->builder->whereIn('currency_id', $value);
        }

        public function original_price_min($value): void
        {
            if (!$value) {
                return;
            }

            $this->builder->where('original_price', '>', $value);
        }

        public function original_price_max($value): void
        {
            if (!$value) {
                return;
            }

            $this->builder->where('original_price', '<', $value);
        }

        public function rating_min($value): void
        {
            if (!$value) {
                return;
            }

            $this->builder->where('rating', '>', $value);
        }

        public function rating_max($value): void
        {
            if (!$value) {
                return;
            }

            $this->builder->where('rating', '<', $value);
        }

        public function is_active($value): void
        {
            $this->builder->onlyActive();
        }

        public function search($value)
        {
            $this->builder->where('id', 'LIKE', '%' . $value . '%')
                ->orWhereTranslationILike('name', '%' . $value . '%');
        }

        public function name($value): void
        {
            $this->builder->whereTranslationILike('name', $value);
        }
    }