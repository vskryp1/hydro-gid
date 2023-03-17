<?php
    
    namespace App\Http\Controllers\Frontend;
    
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Frontend\Review\SaveFormRequest;
    use App\Models\Reviews\Review;
    use RealRashid\SweetAlert\Facades\Alert;
    
    class ReviewController extends Controller
    {
        public function store(SaveFormRequest $request)
        {
            Review::create($request->all());

            $options = [
                'anchor' => '#reviews-tab'
            ];

            return $this->redirect('success', __('frontend/review/index.stored'), $options);
        }

        public function index()
        {
            $reviews = Review::onlyActive()->sortByDesc('created_at')->get();
            return view('frontend.templates.review.index', compact($reviews));
        }
    }
