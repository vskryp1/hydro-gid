<?php

    namespace App\Http\Controllers\Backend\Sliders;

    use App\Helpers\ShopHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Backend\Sliders\StoreRequest;
    use App\Models\Sliders\Slider;
    use App\Models\Sliders\SliderItem;
    use Cache;
    use Illuminate\Http\Request;
    use function request;

    /**
     * Class RegionController
     *
     * @package App\Http\Controllers\Backend
     */
    class SlidersController extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->middleware('permission:list sliders', ['only' => ['index']]);
            $this->middleware('permission:add sliders', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit sliders', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete sliders', ['only' => ['destroy']]);
        }

        /**
         * Display a listing of the resource.
         *
         * @param Request $request
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index(Request $request)
        {
            $filters = Slider::with(['translations'])
                ->when($request->has('search'), function ($query) {
                    return $query->whereHas('translations', function ($query) {
                        return $query->where('name', 'like', "%" . request('search') . "%");
                    });
                });

            return view('backend.sliders.index', [
                'sliders'    => $filters->paginate($request->get('limit') ?? ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination'))),
                'permission' => 'sliders',
            ]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('backend.sliders.create', []);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  StoreRequest $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(StoreRequest $request)
        {
            $data           = $request->all();
            $data['active'] = isset($request->active);
            $slider         = Slider::create($data);
            Cache::tags('sliders')->flush();
            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.sliders.edit', ['slider' => $slider])
                    : route('backend.sliders.index')
            )->with('success', ['text' => __('backend.slider_created')]);
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
            $slider = Slider::with(['slider_items'])->findOrFail($id);

            return view('backend.sliders.edit', [
                'slider'       => $slider,
                'slider_items' => SliderItem::whereSliderId($slider->id)->paginate(ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination'))),
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param StoreRequest $request
         * @param              $slider
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(StoreRequest $request, $slider)
        {
            $data           = $request->all();
            $data['active'] = isset($request->active);
            $slider         = Slider::findOrFail($slider);

            $slider->update($data);
            Cache::tags('sliders')->flush();
            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.sliders.edit', ['slider' => $slider])
                    : route('backend.sliders.index')
            )->with('success', ['text' => __('backend.slider_updated')]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  string $slider
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy($slider)
        {
            Slider::destroy($slider);
            Cache::tags('sliders')->flush();
            return redirect(route('backend.sliders.index'))->with('success', ['text' => __('backend.slider_deleted')]);
        }
    }
