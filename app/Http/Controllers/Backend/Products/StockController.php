<?php

    namespace App\Http\Controllers\Backend\Products;

    use App\Jobs\RevertStockPricesJob;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Backend\Stock\StoreRequest;
    use App\Http\Requests\Backend\Stock\UpdateRequest;
    use App\Models\Page\Page;
    use App\Models\Stock\Stock;
    use App\Services\StockService;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Http\Request;
    use App\Models\Product\Product;
    use Redirect;
    use View;
    use function request;

    /**
     * Class StockController
     *
     * @package App\Http\Controllers\Backend\Products
     */
    class StockController extends Controller
    {

        protected $permission = 'stocks';

        /**
         * StockController constructor.
         */
        public function __construct()
        {
            parent::__construct();
            $this->middleware('permission:list ' . $this->permission, ['only' => ['index']]);
            $this->middleware('permission:add ' . $this->permission, ['only' => ['create', 'store']]);
            $this->middleware('permission:edit ' . $this->permission, ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete ' . $this->permission, ['only' => ['destroy']]);
        }

        /**
         * Display a listing of the resource.
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Contracts\View\View
         */
        public function index(Request $request)
        {
            $stocks     = Stock::query()
                ->when(
                    $request->has('search') && $request->get('search') != '',
                    function (Builder $query) {
                        return $query->whereTranslationLike('name', '%' . request('search') . '%');
                    }
                )
                ->orderByDesc('start_date')
                ->byPosition()
                ->paginate(config('app.limits.backend.pagination', 20));
            $permission = $this->permission;

            return View::make('backend.stocks.index', compact('stocks', 'permission'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Contracts\View\View
         */
        public function create()
        {
            $products   = Product::onlyActive()->whereDoesntHave('stock', function ($stock){
                $stock->goinOn()->onlyActive();
            })->get()->pluck('name', 'id');
            $categories = Page::productCategories()->get()->pluck('name', 'id')->toArray();

            return View::make('backend.stocks.create', compact('products', 'categories'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \App\Http\Requests\Backend\Stock\StoreRequest $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store(StoreRequest $request)
        {
            if (Stock::goinOn()
                ->onlyActive()
                ->pluck('id')
                ->intersect($request->products)
                ->isNotEmpty()
            ) {
                return Redirect::route('backend.stocks.index')
                    ->with('info', ['text' => __('backend/stocks/index.some_products_in_stock')]);
            }
            $stock = Stock::create($request->all());
            (new StockService($stock))->updateRelations($request->products);

            if ($request->get('action') == 'continue') {
                return Redirect::route('backend.stocks.edit', $stock)
                    ->with('success', ['text' => __('backend/stocks/index.created')]);
            }

            return Redirect::route('backend.stocks.index')
                ->with('success', ['text' => __('backend/stocks/index.created')]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param string $stock
         *
         * @return \Illuminate\Contracts\View\View
         */
        public function edit(string $stock)
        {
            $stock      = Stock::with(['products'])->findOrFail($stock);
            $products   = Product::onlyActive()->whereDoesntHave('stock', function ($query){
                $query->goinOn()->onlyActive();
            })->orWhereHas('stock', function ($query) use ($stock){
                $query->where('id', $stock->id);
            })->get()->pluck('name', 'id');
            $categories = Page::productCategories()->get()->pluck('name', 'id')->toArray();

            return View::make('backend.stocks.edit', compact('stock', 'products', 'categories'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \App\Http\Requests\Backend\Stock\UpdateRequest $request
         * @param string                                         $srock
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(UpdateRequest $request, string $stock)
        {
            $stock = Stock::findOrFail($stock);
            if (Stock::goinOn()
                ->onlyActive()
                ->pluck('id')
                ->where('id', '!=', $stock->id)
                ->intersect($request->products)
                ->isNotEmpty()
            ) {
                return Redirect::route('backend.stocks.edit', $stock)
                    ->with('info', ['text' => __('backend/stocks/index.edit')]);
            }
            $stock->update($request->all());
            RevertStockPricesJob::dispatchNow($stock, $stock->products);
            (new StockService($stock))->updateRelations($request->products);

            if ($request->get('action') == 'continue') {
                return Redirect::route('backend.stocks.edit', $stock)
                    ->with('success', ['text' => __('backend/stocks/index.updated')]);
            }

            return Redirect::route('backend.stocks.index')
                ->with('success', ['text' => __('backend/stocks/index.updated')]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param string $stock
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy(Stock $stock)
        {
            dispatch(new RevertStockPricesJob($stock, $stock->products));
            $stock->delete();

            return Redirect::route('backend.stocks.index')
                ->with('success', ['text' => __('backend/stocks/index.deleted')]);
        }

    }
