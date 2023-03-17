<?php

    namespace App\QueryFilters;

    use Illuminate\Http\Request;

    abstract class QueryFilter
    {
        protected $builder;

        protected $request;

        public function __construct(Request $request)
        {
            $this->request = $request;
        }

        public function apply($builder)
        {
            $this->builder = $builder;

            foreach ($this->filters() as $filter => $value) {
                if (method_exists($this, $filter)) {
                    $this->$filter($value);
                }
            }
            return $this->builder;
        }


        public function filters()
        {
            $filters = $this->request->get('filters', []);

            if ($this->request->has('search')) {
                $filters['search'] = $this->request->get('search');
            }

            return $filters;
        }
    }
