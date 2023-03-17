<?php

    namespace App\Singletons;


    class SchemaOrgData
    {
        protected $breadcrumbs = null;
        protected $web_page = null;
        protected $product = null;
        protected $local_business = null;

        public function getBreadcrumbs()
        {
            return $this->breadcrumbs;
        }

        public function setBreadcrumbs($value)
        {
            $this->breadcrumbs = $value;
        }

        public function getWebPage()
        {
            return $this->web_page;
        }

        public function setWebPage($value)
        {
            $this->web_page = $value;
        }

        public function getProduct()
        {
            return $this->product;
        }

        public function setProduct($value)
        {
            $this->product = $value;
        }

        public function getLocalBusiness()
        {
            return $this->local_business;
        }

        public function setLocalBusiness($value)
        {
            $this->local_business = $value;
        }

        public function getAllData()
        {
            return [
                'breadcrumbs'   => $this->breadcrumbs,
                'webPage'       => $this->web_page,
                'product'       => $this->product,
                'localBusiness' => $this->local_business,
            ];
        }
    }