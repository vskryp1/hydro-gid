<?php

    namespace App\Singletons;


    class BreadcrumbsData
    {
        protected $breadcrumbs = [];

        public function getBreadcrumbs()
        {
            return $this->breadcrumbs;
        }

        public function setBreadcrumbs($value)
        {
            $this->breadcrumbs = $value;
        }

        public function addBreadcrumb($crumb)
        {
            $this->breadcrumbs[] = $crumb;
        }

        public function getAllData()
        {
            return [
                'breadcrumbs' => $this->breadcrumbs,
            ];
        }
    }