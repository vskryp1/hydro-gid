<?php

namespace App\Http\Controllers\Backend\Templates;

use App\Http\Requests\Backend\Template\MailTemplatesRequest;
use App\Jobs\ChunkNewsLetter;
use App\Models\MailTemplate;
use App\Models\Subscriber;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailTemplatesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:list mail', ['only' => ['index']]);
        $this->middleware('permission:add mail', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit mail', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete mail', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        return view('backend.mail_templates.index', [
            'mailTemplates' => MailTemplate::paginate($request->get('limit', config('app.mail_template_limit', 12))),
            'permission'    => 'mail',
        ]);
    }

    public function create()
    {
        return view('backend.mail_templates.create', ['templates' => Template::formattedResultForSelect()]);
    }

    public function store(MailTemplatesRequest $request)
    {
        $mailTemplate              = new MailTemplate();
        $mailTemplate->name        = $request->name;
        $mailTemplate->template_id = $request->template_id;
        $mailTemplate->save();

        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.mail.email.templates.edit', ['template' => $mailTemplate])
                : route('backend.mail.email.templates.index')
        )->with('success', ['text' => __('backend.mail_email_template_created')]);
    }

    public function edit(MailTemplate $template)
    {
        return view('backend.mail_templates.edit', ['template' => $template, 'templates' => Template::formattedResultForSelect()]);
    }

    public function update(MailTemplate $template, MailTemplatesRequest $request)
    {
        $template->name        = $request->name;
        $template->template_id = $request->template_id;
        $template->save();

        return redirect(
            $request->get('action') == 'continue'
                ? route('backend.mail.email.templates.edit', ['template' => $template])
                : route('backend.mail.email.templates.index')
        )->with('success', ['text' => __('backend.mail_email_template_updated')]);
    }

    public function destroy(MailTemplate $template)
    {
        $template->delete();
        return redirect()->route('backend.mail.email.templates.index')->with('success', ['text' => __('backend.mail_email_template_deleted')]);
    }

    /**
     * start send letters
     * @param MailTemplate $template
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function startNewsLetter(MailTemplate $template)
    {
        $subscribers = Subscriber::all();
        $template->update(['all' => $subscribers->count(), 'current' => 0]);
        dispatch(new ChunkNewsLetter($subscribers, Carbon::now(), $template));
        return redirect(route('backend.mail.email.templates.index'))->with('success', [ 'text' => __('backend.newsletter_start')]);
    }



}
