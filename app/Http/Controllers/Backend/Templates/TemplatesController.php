<?php

namespace App\Http\Controllers\Backend\Templates;

use App\Http\Requests\Backend\Template\TemplateRequest;
use App\Models\Template;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplatesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:list mail', ['only' => ['index']]);
        $this->middleware('permission:add mail', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit mail', ['only' => ['edit', 'update', 'updateMainTemplate', 'editMainTemplate']]);
        $this->middleware('permission:delete mail', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('backend.templates.index', [
            'templates' => Template::paginate($request->get('limit', config('app.template_limit', 12))),
            'permission' => 'mail'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.templates.create', ['langs' => \Setting::get('locales')]);
    }

    public function store(TemplateRequest $request)
    {
        $template = Template::create($request->except(['_token', 'action']));

        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.mail.templates.edit', ['template' => $template])
                : route('backend.mail.templates.index')
        )->with('success', ['text' => __('backend.mail_template_created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        return view('backend.templates.edit', ['template' => $template, 'langs' => \Setting::get('locales')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TemplateRequest $request, Template $template)
    {
        $template->update($request->except(['_token', 'action']));

        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.mail.templates.edit', ['template' => $template])
                : route('backend.mail.templates.index')
        )->with('success', ['text' => __('backend.mail_template_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Template $template
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->route('backend.mail.templates.index')->with('success', ['text' => __('backend.mail_template_deleted')]);
    }

    public function editMainTemplate()
    {
        return view(
            'backend.templates.edit_main_template',
            ['body' => File::get(resource_path('/views/frontend/mails/layout.blade.php'))]
        );
    }

    public function updateMainTemplate(Request $request)
    {
        File::put(resource_path('/views/frontend/mails/layout.blade.php'), $request->body);
        return redirect(route('backend.edit.main.template'))->with('success', ['text' => __('backend.mail_template_updated')]);
    }
}
