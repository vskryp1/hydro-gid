<?php

namespace App\Http\Controllers\Backend\Products;

use App;
use App\Helpers\ImageHelper;
use App\Helpers\ProductHelper;
use App\Helpers\ShopHelper;
use App\Http\Requests\Backend\Products\StoreRequest;
use App\Http\Requests\Backend\Products\UpdateRequest;
use App\Http\Requests\Backend\Products\UploadImageRequest;
use App\Jobs\ProductStockPriceRecalcJob;
use App\Jobs\ResizeImageJob;
use App\Models\Currency\Currency;
use App\Models\Page\Page;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductStatus;
use App\Models\Seo\Sitemap;
use App\Repositories\ProductRepository;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use App\Enums\ProductStatus as ProductStatusEnum;

    /**
     * Class ProductsController
     * @package App\Http\Controllers\Backend
     *
     */
    class ProductsController extends Controller
    {
        private $repository;
        
        public function __construct(Request $request)
        {
            $this->repository = new ProductRepository($request);
            parent::__construct();
            ini_set('max_execution_time', 8000000); // for infinite time of execution 
            set_time_limit(8000000);
            $this->middleware('permission:list products', ['only' => ['index']]);
            $this->middleware('permission:add products', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit products', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete products', ['only' => ['destroy']]);
        }
        
        /**
         * Display a listing of the resource.
         *
         * @param Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request)
        {
            

            $products = Product::with([
                'pages.translations',
                'currency',
                'product_status',
                'translations',
                'images',
            ])
            ->orderBy('updated_at', 'DESC');

            if ($request->has('search')) {
                $products = $products
                ->where('sku', 'LIKE', "%" . $request->search . "%")
                ->orWhereTranslationLike('name', "%" . $request->search . "%");
            }

            if ($request->has('gidro_updates')) {

                $productsGidro = $products
                ->orWhereTranslationLike('name', "%электромагнитный гидрораспределитель%")->get();
                foreach ($productsGidro as $gidro) {
                    if(!$gidro->getMainCategoryAttribute()) {
                       $categories = [];
                       $categories['9755d3c7-eb50-421d-80fe-3dcf07d8aef2'] = [
                        'is_main' => 1,
                    ];
            //update categories in group or single
                    $gidro->pages()->get()->map(function($page) use (&$categories)
                    {
                        if(!$page->page_template()->first()->is_category)
                        {
                            $categories = array_merge($categories, [$page->id => ['is_main' => false]]);
                        }
                    });
                    $gidro->pages()->sync($categories);
                }
            }
            

            die;
            
        }
        $products = $products->paginate($request->get('limit',
            ShopHelper::setting('backend_paginate_limit', config('app.limits.backend.pagination', 25))));
        if($request->has('search'))
        {
            $products->appends(['search' => $request->search]);
        }

        return view('backend.products.index', [
            'products' => $products,
            'permission' => 'products',
        ]);
    }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('backend.products.create', [
                'categories' => Page::productCategories()->get()->pluck('name', 'id')->toArray(),
                'product_statuses' => ProductStatus::onlyActive()->byPosition()->get()->pluck('name', 'id')->toArray(),
                'currencies_list' => Currency::onlyActive()->byDefault()->get()->pluck('full_name', 'id')->toArray(),
                'permission' => 'products',
            ]);
        }

	    /**
	     * Create the specified resource in storage.
	     *
	     * @param StoreRequest $request
	     *
	     * @return \Illuminate\Http\Response
	     */
        public function store(StoreRequest $request)
        {
            $product = Product::create($this->repository->prepareData());

            // creating warranties
            if(isset($request->warranties['amount'])) {
              $product->warranties()->create($request->warranties);
          }

            // move temporary images
          if (isset($request->images) && is_array($request->images)) {
            foreach ($request->images as $image) {
                if (!is_null($image['image'])) {
                    Storage::disk('public')->move(Product::GALLERY_PATH . 'tmp/' . $image['image'],
                        Product::GALLERY_PATH . $product->id . '/' . $image['image']);
                }
            }
        }
        
        $this->repository->updateRelationModels($product);
        
        return redirect(
            $request->get('action') == 'continue'
            ? route('backend.products.edit', ['product' => $product])
            : route('backend.products.index')
        )->with('success', ['text' => __('backend.product_created')]);
        
    }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param   $product
         *
         * @return \Illuminate\Http\Response
         */
        public function edit($product)
        {
            $product = Product::with(['images', 'filter_values', 'pages', 'productRelations', 'similarProducts'])
            ->findOrFail($product);
            if($product->inStock()){
                $product->product_status_id = ProductHelper::getProductStatus(ProductStatusEnum::STOCK)->id;
            }
            return view('backend.products.edit', [
                'product' => $product,
                'categories' => Page::productCategories()->get()->pluck('name', 'id')->toArray(),
                'product_categories' => $product->pages->pluck('id')->toArray(),
                'product_statuses' => ProductStatus::onlyActive()->byPosition()->get()->pluck('name',
                    'id')->toArray(),
                'currencies_list' => Currency::onlyActive()->byDefault()->get()->pluck('full_name', 'id')->toArray(),
                'permission' => 'products',
            ]);
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param UpdateRequest $request
         *
         * @return \Illuminate\Http\Response
         */
        public function update(UpdateRequest $request, Product $product)
        {
            $product->update($this->repository->prepareData(!$product->inStock()));
            $this->repository->updateRelationModels($product);
            if($product->inStock()){
                dispatch(new ProductStockPriceRecalcJob($product));
            }

            return redirect(
                $request->get('action') == 'continue'
                ? route('backend.products.edit', ['product' => $product])
                : route('backend.products.index')
            )->with('success', ['text' => __('backend.product_updated')]);
        }
        
        public function destroy($product)
        {
            Product::destroy($product);
            Sitemap::whereModel('Products')->whereModelId($product)->delete();
            return redirect()->route('backend.products.index')->with('success',
                ['text' => __('backend.product_deleted')]);
        }

        public function galleryUpload(UploadImageRequest $request, $product)
        {
            $path = Product::GALLERY_PATH . $product;
            $name = ImageHelper::generateName($path, $request->file('file')->getClientOriginalName());
            $image = Storage::disk('public')->putFileAs($path, $request->file('file'), $name);

            return response()->json([
                'status' => 'OK',
                'file' => Storage::url($image),
                'file_name' => $name,
            ], 200);
        }
        
        /**
         * search products from autocomplete
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function search(Request $request)
        {
            $search = trim($request->get('q', ''));
            $products = Product::with(['currency'])
            ->when($request->get('type') == 'group', function ($query) {
                return $query->doesnthave('children');
            })
            ->where(function ($query) use ($search) {
                return $query->where('sku', 'LIKE', "%" . $search . "%")
                ->orWhereTranslationLike('name', "%" . $search . "%");
            });
            
            $products = $products->take(10)->get();
            $currency = Currency::find($request->currency);
            if ($products->count()) {
                $products = $products->map(function ($product) use ($request, $currency) {
                    $product->price = round(ShopHelper::price_convert($product->original_price, $product->currency, $currency), 2);
                    $product->currency_order = $currency;
                    $product->image_url = $product->cover->getUrl('prod_md');
                    return $product;
                });
            }
            
            return response()->json($products);
        }
        
        public function groupEdit(Product $product)
        {
            return view('backend.products.group', [
                'product' => $product->id,
                'group_products' => Product::whereParentId($product->parent_id)->orWhere('id',
                    $product->parent_id)->orderBy('group_position')->get(),
            ]);
        }
        
        public function groupUpdate(Request $request, Product $product)
        {
            $data = $request->all();
            if (isset($data['parent']) && is_null($data['parent'])) {
                $data['parent'] = reset($data['products']);
            }
            
            if (isset($data['products']) && is_array($data['products'])) {
                foreach ($data['products'] as $position => $group_product) {
                    Product::find($group_product)->update([
                        'parent_id' => $data['parent'],
                        'group_position' => (int)$position
                    ]);
                }
            }
            Cache::tags('products')->flush();
            return redirect(
                $request->get('action') == 'continue'
                ? route('backend.products.group.edit', ['product' => $product->id])
                : route('backend.products.edit', ['product' => $product->id]) . '#group'
            )->with('success', ['text' => __('backend.product_group_saved')]);
        }
        
        public function removeGroup(Product $product, Product $parent = null)
        {
            $product->update(['parent_id' => null]);
            
            if ($parent) {
                Product::whereParentId($product->id)->update(['parent_id' => $parent->id]);
                $parent->update(['parent_id' => null]);
            }
            Cache::tags('products')->flush();
            return response()->json(['status' => 'OK']);
        }
        
        
        public function copy(Request $request, $product)
        {
            $product = Product::findOrFail($product);
            $copyTemplate = 'copy-' . Str::random(3);
            $alias = $product->getOriginal('alias');
            if (strpos($alias, $copyTemplate)) {
                $alias = mb_substr($alias, 0, strpos($alias, $copyTemplate));
                $product->name = mb_substr($product->name, 0, strpos($product->name, $copyTemplate));
                $product->sku = mb_substr($product->sku, 0, strpos($product->sku, $copyTemplate));
            }
            $newProduct = $product->replicateWithTranslations();
            
            $copiedProductsAmount = Product::where('alias', 'like', $alias . $copyTemplate . '%')->count();
            if ($copiedProductsAmount > 0) {
                $number = $copiedProductsAmount + 1;
            }
            
            
            $newProduct->alias = $alias . $copyTemplate;
            $newProduct->parent_id = null;
            $newProduct->sku = $product->sku . $copyTemplate;
            
            $newProduct->push();
            foreach ($product->warranties as $warranty) {
                $newWarranty = $warranty->replicate();
                $newWarranty->product_id = $newProduct->id;
                $newWarranty->push();
            }
            $newProduct->pages()->sync($product->pages);
            $newProduct->filter_values()->sync($product->filter_values);
            foreach ($product->images as $image) {
                $newImage = $image->replicate();
                $newImage->product_id = $newProduct->id;
                $newImage->push();
                $from = Product::GALLERY_PATH . $product->id . '/' . $image->getOriginal('image');
                $to = Product::GALLERY_PATH . $newProduct->id . '/' . $newImage->getOriginal('image');
                Storage::disk('public')->copy($from, $to);
            }
            Cache::tags('products')->flush();
            return redirect(
                $request->get('action') === 'continue'
                ? route('backend.products.edit', ['product' => $product])
                : route('backend.products.index')
            )->with('success', ['text' => __('backend.product_copied')]);
        }
    }