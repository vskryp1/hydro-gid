<?php

    namespace App\Traits;


    use Illuminate\Support\Str;

    trait AliasTrait
    {
        public $aliasRowName = 'alias';
        public $titleRowName = 'name';
        public $separator    = '-';
        public $without      = ['translations'];

        public function generateAlias()
        {
            return method_exists($this, 'getTranslation') && isset($this->getTranslation()->{$this->titleRowName})
                ? Str::slug($this->getTranslation()->{$this->titleRowName})
                : uniqid();
        }

        public function canUseSlashes(){
            return $this->useSlashes ?? false;
        }

        public function canUsePoint(){
            return $this->usePoint ?? false;
        }

        public function transformAlias($title, $language = 'en')
        {
            $title = $language ? Str::ascii($title, $language) : $title;

            // Convert all dashes/underscores into separator
            $flip = $this->separator === '-' ? '_' : '-';

            $title = preg_replace('!['.preg_quote($flip).']+!u', $this->separator, $title);

            // Replace @ with the word 'at'
            $title = str_replace('@', $this->separator.'at'.$this->separator, $title);

            // Remove all characters that are not the separator, letters, numbers, or whitespace.
            $title = preg_replace('![^'.preg_quote($this->separator)
                .($this->canUseSlashes() ? preg_quote('/') : '')
                .($this->canUsePoint() ? preg_quote('\.') : '')
                .'\pL\pN\s]+!u', '', mb_strtolower($title));

            // Replace all separator characters and whitespace by a single separator
            $title = preg_replace('!['.preg_quote($this->separator).'\s]+!u', $this->separator, $title);

            if($this->canUseSlashes()) {
                $title = $this->cleanAlias($title, '/');
            }

            if($this->canUsePoint()) {
                $title = $this->cleanAlias($title, '.');

                //Remove all points except for first
                $title = preg_replace( '/^([^\.]*\.)|\./', '$1', $title);
            }

            return trim($title, $this->separator);
        }

        public function checkAlias($alias)
        {
            $setNewAlias   = false;
            $separated     = $alias . $this->separator;
            $existsAliases = $this->getMorphClass()::existsAliases($alias, $separated)->get();

            if ($existsAliases) {
                $num = 0;
                $start = strlen($separated);
                foreach ($existsAliases as $row) {
                    $rowNum      = substr($row->getOriginal($this->aliasRowName), $start);
                    $setNewAlias = $setNewAlias || $alias == $row->getOriginal($this->aliasRowName);
                    if (($alias == $row->getOriginal($this->aliasRowName) && $num == 0) || (is_numeric($rowNum) && $rowNum > $num)) {
                        $num      = $rowNum;
                        $newAlias = $separated . ($num + 1);
                    }
                }
            }
            return $setNewAlias ? $newAlias : $alias;
        }

        public function setAliasAttribute($value)
        {
            $value = $this->transformAlias($value);
            $value = $value == '' ? $this->generateAlias() : $value;

            $this->attributes[$this->aliasRowName] = $this->checkAlias($value);
        }

        public function scopeExistsAliases($query, $alias, $separated)
        {
            return $query->without($this->without)
                ->where($this->getKeyName(), '<>', $this->{$this->getKeyName()})
                ->where(function ($query) use ($alias, $separated) {
                    $query->where($this->aliasRowName, $alias)->orWhere($this->aliasRowName, 'like', $separated . '%');
                });
        }

        public function cleanAlias($title, $separator)
        {
            // Replace all double #separator characters by a single $separator
            $title = preg_replace('![' . preg_quote($separator) . ']+!u', $separator, $title);

            //remove $separator from end alias
            $title = preg_replace('!(.+)' . preg_quote($separator) . '$!u', '$1', $title);

            //remove $separator from start alias
            $title = preg_replace('!^' . preg_quote($separator) . '(.+)!u', '$1', $title);

            return $title;
        }
    }
