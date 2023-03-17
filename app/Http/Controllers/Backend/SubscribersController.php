<?php

    namespace App\Http\Controllers\Backend;

    use App\Jobs\ChunkNewsLetter;
    use App\Models\Subscriber;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;

    class SubscribersController extends Controller
    {
        public function index(Request $request)
        {
            return view('backend.subscribers.index', ['subscribers' => Subscriber::paginate($request->get('limit', 25))]);
        }

        public function settings()
        {
            return view('backend.subscribers.settings');
        }

        public function setSettings(Request $request)
        {
            $data = $request->except(['_method', '_token']);
            foreach ($data as $key => $value) {
                \Setting::set($key, $value);
            }
            return redirect(route('backend.subscribers.settings'))->with('success', 'Settings saved.');
        }

        public function destroy(Subscriber $subscriber)
        {
            $subscriber->delete();

            return redirect()->route('backend.subscribers.index')->with('success', 'Subscriber removed successfully');
        }

        public function startNewsLetter()
        {
            dispatch(new ChunkNewsLetter(Subscriber::all(), Carbon::now()));

            return redirect(route('backend.subscribers.index'))->with('success', 'Newsletter started.');
        }
    }
