<?php

    namespace App\Http\Controllers\Backend\Settings;

    use App\Events\ChangeCurrencyCourseEvent;
    use App\Http\Requests\Backend\Currencies\SaveCurrencyRequest;
    use App\Models\Currency\Course;
    use App\Models\Currency\Currency;
    use Artisan;
    use App\Http\Controllers\Controller;

    class CurrencyController extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->middleware('permission:list currencies', ['only' => ['index']]);
            $this->middleware('permission:add currencies', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit currencies', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete currencies', ['only' => ['destroy']]);
        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index()
        {
            return view('backend.currencies.index', [
                'currencies_list' => Currency::all(),
                'permission' => 'currencies',
                'currents'   => Currency::onlyActive()->with('course')->get(),
                'courses'    => Course::whereDate('created_at', '=',
                    request()->get('date') ?: date(config('app.formats.php.date')))
                    ->orderBy('currency_id')
                    ->orderBy('created_at', 'desc')
                    ->get(),
            ]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function create()
        {
            return view('backend.currencies.create', []);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  SaveCurrencyRequest $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(SaveCurrencyRequest $request)
        {
            $currency           = new Currency();
            $currency->code     = $request->code;
            $currency->name     = $request->name;
            $currency->sign     = $request->sign;
            $currency->position = (int)$request->position;
            $currency->active   = $request->active == true ?: false;
            if ($request->default == true && $request->active == true) {
                //reset all default
                Currency::whereDefault(true)->update(['default' => false]);
                $currency->default = $request->default;
            }
            $currency->save();

            $course = 1;
            if (isset($request->course) && (float)$request->course > 0) {
                $course = (float)$request->course;
            }
            $currency->courses()->create(['course' => $course]);

            event(new ChangeCurrencyCourseEvent());

            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.settings.currencies.edit', ['currency' => $currency])
                    : route('backend.settings.currencies.index')
            )->with('success', ['text' => __('backend.currency_added')]);
        }

        /**
         * Display the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            return view('backend.currencies.edit', ['currency' => Currency::findOrFail($id)]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  SaveCurrencyRequest $request
         * @param  int                 $id
         *
         * @return \Illuminate\Http\Response
         */
        public function update(SaveCurrencyRequest $request, $id)
        {
            $currency           = Currency::findOrFail($id);
            $currency->code     = $request->code;
            $currency->name     = $request->name;
            $currency->sign     = $request->sign;
            $currency->position = (int)$request->position;
            $currency->active   = $request->active == true ?: false;
            if ($request->default == true && $request->active == true) {
                //reset all default
                Currency::whereDefault(true)->update(['default' => false]);
                $currency->default = true;
            }
            $currency->save();

            if (isset($request->course) && (float)$request->course > 0) {
                $currency->courses()->create(['course' => (float)$request->course]);
            }

            event(new ChangeCurrencyCourseEvent());

            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.settings.currencies.edit', ['currency' => $currency])
                    : route('backend.settings.currencies.index')
            )->with('success', ['text' => __('backend.currency_updated')]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $currency = Currency::findOrFail($id);
            if ($currency->default == 1) {
                return back()->with('danger', ['text' => __('backend.currency_delete_error')]);
            }
            Currency::destroy($id);
            event(new ChangeCurrencyCourseEvent());
            return redirect(route('backend.settings.currencies.index'))->with('success', ['text' => __('backend.currency_deleted')]);
        }

        /**
         * Get actual curses
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function actualCourses()
        {
            try {
                Artisan::call('currencies:course');
            } catch (\Exception $exception) {
                return redirect(route('backend.settings.currencies.index'))->with('danger',
                    ['text' => __('backend.currency_error')/*$exception->getMessage()*/]);
            }
            return redirect(route('backend.settings.currencies.index'))->with('success',
                ['text' => __('backend.currency_updated')]);
        }
    }
