<?php

    namespace App\Http\Controllers\Backend\Faq;

    use App\Http\Requests\Backend\Faq\FaqRequest;
    use App\Http\Controllers\Controller;
    use App\Models\Faq\Faq;

    class FaqController extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->middleware('permission:list faq', ['only' => ['index']]);
            $this->middleware('permission:add faq', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit faq', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete faq', ['only' => ['destroy']]);
        }
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('backend.faqs.index', [
                'faqs'       => Faq::paginate(config('app.limits.backend.pagination')),
                'permission' => 'faq',
            ]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('backend.faqs.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(FaqRequest $request)
        {
            $faq = Faq::create($request->all());

            return redirect($request->get('action') == 'continue'
                ? route('backend.faqs.edit', $faq)
                : route('backend.faqs.index'))->with('success', ['text' => __('backend.created_successfully')]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  Faq $faq
         *
         * @return \Illuminate\Http\Response
         */
        public function edit(Faq $faq)
        {
            return view('backend.faqs.edit', [
                'faq' => $faq,
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  FaqRequest $request
         * @param  Faq        $faq
         *
         * @return \Illuminate\Http\Response
         */
        public function update(FaqRequest $request, Faq $faq)
        {
            $faq->update($request->all());

            return redirect($request->get('action') == 'continue'
                ? route('backend.faqs.edit', $faq)
                : route('backend.faqs.index'))->with('success', ['text' => __('backend.updated_successfully')]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  Faq $faq
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy(Faq $faq)
        {
            $faq->delete();
            return redirect()
                ->route('backend.faqs.index')
                ->with('success', ['text' => __('backend.deleted_successfully')]);
        }
    }

