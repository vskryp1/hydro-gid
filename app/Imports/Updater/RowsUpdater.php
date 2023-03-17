<?php

    namespace App\Imports\Updater;

    use Illuminate\Database\Eloquent\Model;

    abstract class RowsUpdater
    {
        public  $model;

        private $headers;

        private $relative;

        public function __construct($headers, $relative)
        {
            $this->headers = $headers;
            $this->relative = $relative;
        }

        public function update(Model $model, array $row): void
        {
            $this->model = $model;

            foreach ($this->headers as $key => $header) {
                if (!empty($this->relative[$key]) && isset($row[$this->relative[$key]])) {
                    [$name, $lang] = $this->separateNameFromLocale($header);

                    if (method_exists($this, $name)) {
                        $this->$name($row[$this->relative[$key]]);
                    } elseif ($lang) {
                        if ($this->model->hasTranslation($lang)) {
                            $translate = $this->model->translate($lang);
                        } else {
                            $translate = $this->model->getNewTranslation($lang);
                        }
                        $translate->$name = (string)$row[$this->relative[$key]];
                    } else {
                        $this->model->setAttribute($name, $row[$this->relative[$key]]);
                    }
                }
            }

            $this->model->save();
        }

        public function separateNameFromLocale(string $header): array
        {
            $header .= config('app.separators.export.header_local_column');

            return explode(config('app.separators.export.header_local_column'), $header);
        }
    }