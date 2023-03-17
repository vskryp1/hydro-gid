<?php

    namespace App\Http\Controllers\Backend\Sliders;

    use App\Helpers\ImageHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Backend\Regions\RegionRequest;
    use App\Http\Requests\Backend\Sliders\StoreSliderItemRequest;
    use App\Jobs\ResizeImageJob;
    use App\Models\Region\Region;
    use App\Models\Sliders\Slider;
    use App\Models\Sliders\SliderItem;
    use Cache;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Http\Request;
    use function request;
    use Setting;
    use Storage;

    /**
     * Class RegionController
     *
     * @package App\Http\Controllers\Backend
     */
    class SliderItemsController extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->middleware('permission:add sliders', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit sliders', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete sliders', ['only' => ['destroy']]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @param $slider
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function create($slider)
        {
            return view('backend.sliders.items.create', ['slider' => $slider]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  StoreSliderItemRequest $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(StoreSliderItemRequest $request)
        {
            $data           = $request->all();
            $data['active'] = isset($request->active);

            $path = Slider::GALLERY_PATH . $data['slider_id'];
            foreach (Setting::get('locales') as $lang => $locale) {
                if (isset($data[$lang]['image'])) {
                    $data[$lang]['image'] = ImageHelper::generateName($path, $request->file($lang . '.image')->getClientOriginalName());
                    Storage::disk('public')->putFileAs($path, $request->file($lang . '.image'), $data[$lang]['image']);
                    dispatch(
                        new ResizeImageJob(
                            $path . DIRECTORY_SEPARATOR . $data[$lang]['image'],
                            config('customimagecache.types.sliders'),
                            'sliders'
                        )
                    );
                }
            }

            $slider_item = SliderItem::create($data);
            Cache::tags('sliders')->flush();
            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.sliders.slider_items.edit',
                    ['slider' => $slider_item->slider_id, 'slider_item' => $slider_item])
                    : route('backend.sliders.edit', ['slider' => $slider_item->slider_id]) . '#slider_items'
            )->with('success', ['text' => __('backend.slider_item_created')]);
        }


        /**
         * Show the form for editing the specified resource.
         *
         * @param $slider
         * @param $slider_item
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function edit($slider, $slider_item)
        {
            return view('backend.sliders.items.edit', [
                'slider_item' => SliderItem::findOrFail($slider_item),
                'slider'      => $slider,
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param StoreSliderItemRequest $request
         * @param                        $slider
         * @param                        $slider_item
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(StoreSliderItemRequest $request, $slider, $slider_item)
        {
            $data           = $request->all();
            $data['active'] = isset($request->active);

            $path = Slider::GALLERY_PATH . $data['slider_id'];
            foreach (Setting::get('locales') as $lang => $locale) {
                if (isset($data[$lang]['image'])) {
                    $data[$lang]['image'] = ImageHelper::generateName($path, $request->file($lang . '.image')->getClientOriginalName());
                    Storage::disk('public')->putFileAs($path, $request->file($lang . '.image'), $data[$lang]['image']);
                    dispatch(
                        new ResizeImageJob(
                            $path . DIRECTORY_SEPARATOR . $data[$lang]['image'],
                            config('customimagecache.types.sliders'),
                            'sliders'
                        )
                    );
                }
            }

            SliderItem::findOrFail($slider_item)->update($data);
            Cache::tags('sliders')->flush();
            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.sliders.slider_items.edit', ['slider' => $slider, 'slider_item' => $slider_item])
                    : route('backend.sliders.edit', ['slider' => $slider]) . '#slider_items'
            )->with('success', ['text' => __('backend.slider_item_updated')]);

        }

        /**
         * Remove the specified resource from storage.
         *
         * @param $slider
         * @param $slider_item
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy($slider, $slider_item)
        {
            SliderItem::destroy($slider_item);
            Cache::tags('sliders')->flush();
            return redirect(route('backend.sliders.edit', ['slider' => $slider]) . '#slider_items')
                ->with('success', ['text' => __('backend.slider_item_deleted')]);
        }
    }
