<?php

    namespace App\Http\Controllers;

    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Foundation\Validation\ValidatesRequests;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Support\Facades\Redirect;

    class Controller extends BaseController
    {
        use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        public function __construct()
        {
        }

        protected function redirect($key, $value = null, array $options = [])
        {
            if (is_null($value)) {
                return Redirect::back(301);
            }

            if (isset($options['anchor'])) {
                return Redirect::to(url()->previous() . $options['anchor'], 301)->with($key, $value);
            }

            return Redirect::back(301)->with($key, $value);
        }
    }
