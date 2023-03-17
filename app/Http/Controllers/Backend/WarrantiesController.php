<?php

    namespace App\Http\Controllers\Backend;

    use App\Models\Page\Page;
    use App\Http\Controllers\Controller;
    use App\Models\Product\ProductWarranty;
    use App\Http\Requests\Backend\WarrantyRequest;

    /**
     * Class WarrantiesController
     * @package App\Http\Controllers\Backend
     *
     */
    class WarrantiesController extends Controller
    {
        /**
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index()
        {
            return view('backend.warranties.index', [
                'permission' => 'products',
                'warranties' => ProductWarranty::categoryWarranty()->paginate()
            ]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @param \App\Models\Product\Product $product
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function create()
        {
            return view(
                'backend.warranties.create',
                [
                    'permission'      => 'products',
                    'categories'      => Page::productCategories()->get()->pluck('name', 'id')->toArray(),
                ]
            );
        }

        /**
         * @param WarrantyRequest $request
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function store(WarrantyRequest $request)
        {
            $warranty = ProductWarranty::create($request->all());
            
            return redirect(
                $request->get('action') === 'continue'
                    ? route('backend.warranties.edit', $warranty)
                    : route('backend.warranties.index')
            )->with('success', ['text' => __('backend.product_warranty_created')]);

        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param \App\Models\Product\Product $product
         *
         * @param \App\Models\Product\ProductWarranty $warranty
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function edit(ProductWarranty $warranty)
        {
            return view(
                'backend.warranties.edit',
                [
                    'categories' => Page::productCategories()->get()->pluck('name', 'id')->toArray(),
                    'warranty'   => $warranty,
                    'permission' => 'products',
                ]
            );
        }

        /**
         * @param WarrantyRequest $request
         * @param ProductWarranty $warranty
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function update(WarrantyRequest $request, ProductWarranty $warranty)
        {
            $warranty->update($request->all());

            return redirect(
                $request->get('action') === 'continue'
                    ? route('backend.warranties.edit', $warranty)
                    : route('backend.warranties.index')
            )->with('success', ['text' => __('backend.product_warranty_update')]);
        }

        /**
         * @param ProductWarranty $warranty
         * @return \Illuminate\Http\RedirectResponse
         * @throws \Exception
         */
        public function destroy(ProductWarranty $warranty)
        {
            $warranty->delete();

            return redirect()
                ->route('backend.warranties.index')
                ->with('success', ['text' => __('backend.product_warranty_deleted')]);
        }
    }