<?php

    namespace App\Events;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Queue\SerializesModels;

    class UrlWasBorn
    {
        use SerializesModels;

        public $model;

        public function __construct(Model $model)
        {
            $this->model = $model;
        }
    }
