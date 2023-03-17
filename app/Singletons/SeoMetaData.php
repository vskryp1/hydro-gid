<?php

    namespace App\Singletons;
    use Illuminate\Support\Facades\Lang;

    class SeoMetaData
    {
        const  STEP_MODULE   = 'module'; //step 1
        const  STEP_PAGE     = 'page'; //step 2
        const  STEP_PRODUCT  = 'product'; //step 2
        const  STEP_FILTER   = 'filter'; //step 3
        const  STEP_PAGINATE = 'paginate'; //step 4

        protected $seo_title       = '';
        protected $seo_description = '';
        protected $seo_keywords    = '';
        protected $seo_robots      = '';
        protected $seo_canonical   = '';
        protected $seo_content     = '';
        protected $step            = '';
        protected $seo_h1          = '';

        public function getSeoTitle()
        {
            return $this->seo_title;
        }

        public function setSeoTitle($value)
        {
            $this->seo_title = $value;
        }

        public function getSeoDescription()
        {
            return $this->seo_description;
        }

        public function setSeoDescription($value)
        {
            $this->seo_description = $value;
        }

        public function getSeoKeywords()
        {
            return $this->seo_keywords;
        }

        public function setSeoKeywords($value)
        {
            $this->seo_keywords = $value;
        }

        public function getSeoRobots()
        {
            return $this->seo_robots;
        }

        public function setSeoRobots($value)
        {
            $this->seo_robots = $value;
        }

        public function getSeoCanonical()
        {
            return $this->seo_canonical;
        }

        public function setSeoCanonical($value)
        {
            $this->seo_canonical = $value;
        }

        public function getSeoContent()
        {
            return $this->seo_content;
        }

        public function setSeoContent($value)
        {
            $this->seo_content = $value;
        }

        public function getStep()
        {
            return $this->step;
        }

        public function setStep($value)
        {
            $this->step = $value;
        }

	    public function getSeoH1()
	    {
		    return $this->seo_h1;
	    }

	    public function setSeoH1($value)
	    {
		    $this->seo_h1 = $value;
	    }

        public function isNotStep($name)
        {
            return $this->step != $name;
        }

        public function getAllData()
        {
            return [
                'seo_title'       => $this->seo_title,
                'seo_description' => $this->seo_description,
                'seo_keywords'    => $this->seo_keywords,
                'seo_robots'      => $this->seo_robots,
                'seo_canonical'   => $this->seo_canonical,
                'seo_content'     => $this->seo_content,
	            'seo_h1'          => $this->seo_h1,
            ];
        }

	    public function getSeoInfo(string $attribute, string $template, array $items = []) : string {
            return Lang::has("frontend.seo_{$attribute}_{$template}")
                ? __("frontend.seo_{$attribute}_{$template}", $items)
                : (Lang::has("frontend.seo_{$attribute}_default")
                    ? __("frontend.seo_{$attribute}_default", $items)
                    : '');
	    }
    }