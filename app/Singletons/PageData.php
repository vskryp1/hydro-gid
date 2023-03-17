<?php

    namespace App\Singletons;


    class PageData
    {
        protected $page              = null;
        
        protected $additional_fields = [];

        public function getPage()
        {
            return $this->page;
        }

        public function setPage($value)
        {
            $this->page = $value;
        }

        public function getAdditionalFields()
        {
            return $this->additional_fields;
        }

        public function getAdditionalField($key)
        {
            return $this->additional_fields[$key] ?? null;
        }

        public function setAdditionalFields($value)
        {
            $this->additional_fields = $value;
        }

        public function addAdditionalField($additional_field, $key = null)
        {
            if ($key) {
                $this->additional_fields[$key] = $additional_field;
            } else {
                $this->additional_fields[] = $additional_field;
            }
        }

        public function getAllData()
        {
            return [
                'page'              => $this->page,
                'additional_fields' => $this->additional_fields,
            ];
        }
    }