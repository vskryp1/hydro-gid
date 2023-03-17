<?php

    namespace App\Http\Controllers\Backend\Products;

    use App\Models\Product\Product;
    use App\Http\Controllers\Controller;
    use App\Models\Product\ProductWarranty;
    use App\Http\Requests\Backend\Products\WarrantyRequest;

    /**
     * Class ProductsController
     * @package App\Http\Controllers\Backend
     *
     */
    class ProductWarrantyController extends Controller
    {
        /**
         * Show the form for creating a new resource.
         *
         * @param \App\Models\Product\Product $product
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function create(Product $product)
        {
            return view('backend.products.warranty.create', [
                'permission' => 'products',
                'product'    => $product,
            ]);
        }

        public function store(WarrantyRequest $request, Product $product)
        {
            $product->warranties()->create($request->all());
            
            return redirect(
                $request->get('action') === 'continue'
                    ? route('backend.products.warranty.edit', ['product' => $product,'warranty' => $product->warranties()->latest()->first()->id])
                    : route('backend.products.edit', $product)
            )->with('success', ['text' => __('backend.product_warranty_created')]);

        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param \App\Models\Product\Product         $product
         *
         * @param \App\Models\Product\ProductWarranty $warranty
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function edit(Product $product, ProductWarranty $warranty)
        {
            return view('backend.products.warranty.edit', [
                'product'    => $product,
                'warranty'   => $warranty,
                'permission' => 'products',
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \App\Http\Requests\Backend\Products\WarrantyRequest $request
         *
         * @param \App\Models\Product\Product                         $product
         * @param \App\Models\Product\ProductWarranty                 $warranty
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function update(WarrantyRequest $request, Product $product, ProductWarranty $warranty)
        {
            $warranty->update($request->all());

            return redirect(
                $request->get('action') === 'continue'
                    ? route('backend.products.edit', ['product' => $product, 'warranty' => $warranty->id])
                    : route('backend.products.edit', $product)
            )->with('success', ['text' => __('backend.product_warranty_updated')]);
        }

        public function destroy(Product $product, ProductWarranty $warranty)
        {
            $warranty->delete();

            return redirect()
                ->route('backend.products.edit', $product)
                ->with('success', ['text' => __('backend.product_warranty_deleted')]);
        }
    }