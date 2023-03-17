<?php

    namespace App\Http\Controllers\Backend\Seo;

    use App\Http\Requests\Backend\Seo\Sitemap\UpdateRequest;
    use App\Jobs\SiteMapGeneratorJob;
    use App\Jobs\SitemapRegisterJob;
    use App\Models\Seo\Sitemap;
    use App\Repositories\SitemapRepository;
    use Artisan;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;

    class SitemapController extends Controller
    {
        private $repo;

        public function __construct(Request $request)
        {
            $this->repo = new SitemapRepository($request);
            parent::__construct();
            $this->middleware('permission:list seo sitemap', ['only' => ['index']]);
            $this->middleware('permission:add seo sitemap', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit seo sitemap', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete seo sitemap', ['only' => ['destroy']]);
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
            $sitemap = Sitemap::query()
                ->when($request->search != '', function ($query) {
                    return $query->where('alias', 'like', '%' . request('search') . '%');
                })->byPosition();

            return view('backend.seo-sitemap.index', [
                'sitemap' => $sitemap->paginate(20),
            ]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Generate sitemap.
         *
         * @return array
         */
        public function generate()
        {
            SitemapRegisterJob::withChain([
                new SiteMapGeneratorJob
            ])->dispatch();

            return redirect()
                ->route('backend.sitemap.index')
                ->with('success', ['text' => __('backend.sitemap_generate_start')] );
        }

        /**
         * Display the specified resource.
         *
         * @param Request $request
         *
         * @return array
         */
        public function getEntities(Request $request)
        {
            return $this->repo->getEntities($request->get('model'));
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
            $sitemap = Sitemap::findOrFail($id);

            return view('backend.seo-sitemap.edit', [
                'sitemap' => $sitemap,
                'changefreq' => Sitemap::$changefreq,
                'models' => $this->repo->models,
                'entities' => $this->repo->getEntities($sitemap->model),
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param UpdateRequest $request
         * @param               $id
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(UpdateRequest $request, $id)
        {
            $sitemap             = Sitemap::find($id);
            $sitemap->lastmod    = $request->lastmod;
            $sitemap->priority   = $request->priority;
            $sitemap->position   = $request->position;
            $sitemap->changefreq = $request->changefreq;
            $sitemap->is_active  = isset($request->is_active);
            $sitemap->save();

            dispatch(new SiteMapGeneratorJob());

            return redirect(
                $request->get('action') == 'continue'
                    ? route('backend.sitemap.edit', ['id' => $sitemap])
                    : route('backend.sitemap.index')
            )->with('success', ['text' => __('backend.sitemap_updated')]);

        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            Sitemap::destroy($id);
            dispatch(new SiteMapGeneratorJob());
            return redirect()->route('backend.sitemap.index')
                ->with('success', ['text' => __('backend.sitemap_deleted')]);
        }


    }
