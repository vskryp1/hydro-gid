<?php

    namespace App\Http\Controllers\Backend\ImportExport;

    use App\Helpers\ExportHelper;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class ImportExportClientController extends Controller
    {
        public function __construct()
        {
            parent::__construct();

            $this->middleware('permission:list import export clients', ['only' => ['index']]);
        }

        public function index(Request $request)
        {
            return view('backend.import-export.clients', [
                'permission' => 'list import export clients',
                'columnsForExport' => ExportHelper::getClientHeadings(),
            ]);
        }
    }
