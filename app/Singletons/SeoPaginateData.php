<?php

    namespace App\Singletons;


    class SeoPaginateData
    {
        protected $prev = '';
        protected $next = '';

        public function getPrev()
        {
            return $this->prev;
        }

        public function setPrev($value)
        {
            $this->prev = $value;
        }

        public function getNext()
        {
            return $this->next;
        }

        public function setNext($value)
        {
            $this->next = $value;
        }

        public function getAllData()
        {
            return [
                'prev' => $this->prev,
                'next' => $this->next,
            ];
        }
    }