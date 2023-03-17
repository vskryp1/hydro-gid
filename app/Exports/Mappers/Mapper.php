<?php

    namespace App\Exports\Mappers;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Request;

    abstract class Mapper
    {
        private $request;

        protected $model;

        public function __construct(Request $request)
        {
            $this->request = $request;
        }

        public function map(Model $model): array
        {
            $this->model = $model;
            $map = [];

            foreach ($this->headers() as $header) {
                [$name, $lang] = $this->separateNameFromLocale($header);

                if (method_exists($this, $name)) {
                    $map[] = $this->$name($lang);
                } else {
                    $map[] = $this->model->$name ?? '';
                }
            }

            return $map;
        }

        public function separateNameFromLocale(string $header): array
        {
            $header .= config('app.separators.export.header_local_column');

            return explode(config('app.separators.export.header_local_column'), $header);
        }

        public function headers(): array
        {
            return $this->request->get('export_fields', []);
        }
    }
