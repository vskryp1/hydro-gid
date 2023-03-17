<?php

    namespace App\Singletons;


    class OgMetaData
    {
        protected $og_title;
        protected $og_description;
        protected $og_img;
        protected $og_locale;
        protected $og_url;

        public function getOgTitle()
        {
            return $this->og_title;
        }

        public function setOgTitle($value)
        {
            $this->og_title = $value;
        }

	    public function getOgLocale()
	    {
		    return $this->og_locale;
	    }

	    public function setOgLocale($value)
	    {
		    $this->og_locale = $value;
	    }

	    public function getOgUrl()
	    {
		    return $this->og_url;
	    }

	    public function setOgUrl($value)
	    {
		    $this->og_url = $value;
	    }

        public function getOgDescription()
        {
            return $this->og_description;
        }

        public function setOgDescription($value)
        {
            $this->og_description = $value;
        }

        public function getOgImg()
        {
            return $this->og_img;
        }

        public function setOgImg($value)
        {
            $this->og_img = $value;
        }

        public function getAllData()
        {
            return [
                'og_title'       => $this->og_title,
                'og_description' => $this->og_description,
                'og_img'         => $this->og_img,
                'og_locale'      => $this->og_locale,
                'og_url'         => $this->og_url,
            ];
        }
    }