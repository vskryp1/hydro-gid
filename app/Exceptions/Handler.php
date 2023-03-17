<?php

    namespace App\Exceptions;

    use Exception;
    use Illuminate\Auth\AuthenticationException;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
    use Illuminate\Support\Arr;
    use Spatie\Permission\Exceptions\UnauthorizedException;
    use Symfony\Component\HttpKernel\Exception\HttpException;
    use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

    /**
     * Class Handler
     *
     * @package App\Exceptions
     */
    class Handler extends ExceptionHandler
    {
        /**
         * A list of the exception types that are not reported.
         *
         * @var array
         */
        protected $dontReport = [];

        /**
         * A list of the inputs that are never flashed for validation exceptions.
         *
         * @var array
         */
        protected $dontFlash = [
            'password',
            'password_confirmation',
        ];

        /**
         * Report or log an exception.
         *
         * @param  \Exception  $exception
         *
         * @return mixed|void
         * @throws \Exception
         */
        public function report(Exception $exception)
        {
            if (app()->bound('sentry') && $this->shouldReport($exception)) {
                app('sentry')->captureException($exception);
            }

            parent::report($exception);
        }

        /**
         * Render an exception into an HTTP response.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Exception                $exception
         *
         * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
         */
        public function render($request, Exception $exception)
        {
            // Convert all non-http exceptions to a proper 500 http exception
            // if we don't do this exceptions are shown as a default template
            // instead of our own view in resources/views/errors/500.blade.php
            if ($this->shouldReport($exception) && ! $this->isHttpException($exception) && ! config('app.debug')) {
                $exception = new HttpException(500, 'Whoops!');
            }

            if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
                if ($request->is(config('app.backend_uri') . '*')) {
                    return response()->view('errors.backend.404', [], 404);
                }

                return response()->view('errors.404', [], 404);
            }

            if ($exception instanceof UnauthorizedException) {
                return response()->view('errors.backend.403', [], 403);
            }

            return parent::render($request, $exception);
        }

        /**
         * Convert an authentication exception into an unauthenticated response.
         *
         * @param  \Illuminate\Http\Request                  $request
         * @param  \Illuminate\Auth\AuthenticationException  $exception
         *
         * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
         */
        protected function unauthenticated($request, AuthenticationException $exception)
        {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }

            $guard = Arr::get($exception->guards(), 0);

            switch ($guard) {
                case 'admin':
                    $login = route('backend.login');

                    break;
                default:
                    $login = route('login');
            }

            return redirect()->guest($login);
        }
    }
