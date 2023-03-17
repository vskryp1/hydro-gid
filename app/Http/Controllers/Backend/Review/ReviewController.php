<?php

    namespace App\Http\Controllers\Backend\Review;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Backend\Review\SaveFormRequest;
    use App\Models\Reviews\Review;

    class ReviewController extends Controller
    {
        public function __construct()
        {
            parent::__construct();

            $this->middleware('permission:list reviews', ['only' => ['index']]);
            $this->middleware('permission:add reviews', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit reviews', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete reviews', ['only' => ['destroy']]);
        }

        public function index()
        {
            $permission = 'reviews';
            $reviews    = Review::query()->orderBy('created_at', 'desc')->paginate(config('app.limits.backend.pagination'));

            return view('backend.reviews.index', compact('reviews', 'permission'));
        }

        public function create()
        {
            $permission = 'reviews';

            return view('backend.reviews.create', compact('permission'));
        }

        public function store(SaveFormRequest $request)
        {
        	$review = Review::create($request->all());

	        return redirect(
		        $request->get('action') == 'continue'
			        ? route('backend.reviews.edit', ['review' => $review])
			        : route('backend.reviews.index')
	        )->with('success', ['text' => __('backend.reviews_edited')]);
        }

        public function edit(Review $review)
        {
            $permission = 'reviews';

            return view('backend.reviews.edit', compact('review', 'permission'));
        }

        public function update(SaveFormRequest $request, Review $review)
        {
            $review->update($request->all());

            if ($request->filled('action')) {
                return redirect()
                    ->back()
                    ->with('success', ['text' => __('backend.reviews_edited')]);
            }

            return redirect()
                ->route('backend.reviews.index')
                ->with('success', ['text' => __('backend.reviews_edited')]);
        }

        public function destroy(Review $review)
        {
            $review->delete();

            return redirect()
                ->route('backend.reviews.index')
                ->with('success', ['text' => __('backend.reviews_deleted')]);
        }
    }
