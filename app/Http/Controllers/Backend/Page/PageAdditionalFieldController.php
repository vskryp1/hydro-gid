<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Requests\Backend\Page\PageAdditionalFieldRequest;
use App\Models\Page\PageAdditionalField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageAdditionalFieldController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission:add pages', ['only' => ['store']]);
        $this->middleware('permission:delete pages', ['only' => ['delete']]);
    }

    public function store(PageAdditionalFieldRequest $request)
    {
        PageAdditionalField::create($request->all());
        return redirect()->back()->with('success', 'Additional field successfully added.');
    }

    public function delete(Request $request)
    {
        PageAdditionalField::findOrFail($request->id)->delete();
        return redirect()->back()->with('success', 'Additional field successfully deleted.');
    }
}