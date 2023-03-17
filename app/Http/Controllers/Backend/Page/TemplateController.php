<?php

    namespace App\Http\Controllers\Backend\Page;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Backend\Page\PageTemplateRequest;
    use App\Models\Page\PageAdditionalField;
    use App\Models\Page\PageAdditionalFieldType;
    use App\Models\Page\PageTemplate;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;

    class TemplateController extends Controller
    {
        public function __construct()
        {
            parent::__construct();

            $this->middleware('permission:list page templates', ['only' => ['index']]);
            $this->middleware('permission:add page templates', ['only' => ['create', 'store']]);
            $this->middleware('permission:edit page templates', ['only' => ['edit', 'update']]);
            $this->middleware('permission:delete page templates', ['only' => ['destroy']]);
        }

        public function index(Request $request)
        {
            $templates = PageTemplate::query()
                ->when(
                    auth('admin')->user()->can('delete page templates'),
                    function($builder) {
                        return $builder->withTrashed();
                    }
                )
                ->orderBy('name')
                ->paginate(10)
                ->appends($request->all());

            return view('backend.page-templates.index', [
                'templates'  => $templates,
                'permission' => 'page templates',
            ]);
        }

        public function create()
        {
            return view('backend.page-templates.create');
        }

        public function store(PageTemplateRequest $request)
        {
            $template = PageTemplate::create($request->all());

            if ($request->filled('content')) {
                Storage::disk('templates')->put(
                    $request->input('folder') . DIRECTORY_SEPARATOR . 'index.blade.php',
                    $request->input('content')
                );
            }

            return redirect(
                $request->input('action') === 'continue'
                    ? route('backend.templates.edit', ['template' => $template])
                    : route('backend.templates.index')
            )->with('success', ['text' => __('backend.template_created')]);
        }

        public function edit(PageTemplate $template)
        {
            $template->content = '';
            $field_types       = PageAdditionalFieldType::all()->pluck('type', 'id');

            $content = $template->folder . DIRECTORY_SEPARATOR . 'index.blade.php';
            if (Storage::disk('templates')->exists($content)) {
                $template->content = Storage::disk('templates')->get($content);
            }

            return view('backend.page-templates.edit', [
                'template'    => $template,
                'field_types' => $field_types,
            ]);
        }

        public function update(PageTemplateRequest $request, PageTemplate $template)
        {
            $template->update($request->all());

            if ($request->filled('content')) {
                Storage::disk('templates')->put(
                    $request->input('folder') . DIRECTORY_SEPARATOR . 'index.blade.php',
                    $request->input('content')
                );
            }

            if (isset($request->add) && count($request->add) > 0) {
                foreach ($request->add as $type => $field) {
                    foreach ($field as $field_id => $value) {
                        $data['active'] = isset($value['active']);
                        if ($type != 'file') {
                            $data['default'] = $value['value'];
                        }
                        PageAdditionalField::where('id', $field_id)->update($data);
                    }
                }
            }

            return redirect(
                $request->input('action') === 'continue'
                    ? route('backend.templates.edit', ['template' => $template])
                    : route('backend.templates.index')
            )->with('success', ['text' => __('backend.template_edited')]);
        }

        public function destroy(string $id)
        {
            $template = PageTemplate::withTrashed()->findOrFail($id);

            if ($template->trashed()) {
                $template->forceDelete();
            } else {
                $template->delete();
            }

            return redirect(
                route('backend.templates.index')
            )->with('success', ['text' => __('backend.template_deleted')]);
        }

        public function restore(string $id)
        {
            $template = PageTemplate::withTrashed()->findOrFail($id);
            $template->restore();

            return redirect(
                route('backend.templates.index')
            )->with('success', ['text' => __('backend.template_restored')]);
        }
    }
