<?php

    namespace App\Collections;

    use Illuminate\Database\Eloquent\Collection;

    class FilterCollection extends Collection
    {
        public function getFilterValueName($filterId): string
        {
            return $this->firstWhere('filter_id', $filterId) ?
                $this->firstWhere('filter_id', $filterId)->name
                : '-';
        }

        public function groupByFiltersPosition(): FilterCollection
        {
            return $this->groupBy(function($model) {
                return $model->filter->position;
            })->sortKeys();
        }

        public function setCheckedValues(array $aliases)
        {
            $this->map(function($model) use ($aliases) {
                $model->checked = in_array($model->alias, $aliases);
            });
        }

        public function getCheckedValues(): FilterCollection
        {
            return $this->where('checked', true);
        }
    }
