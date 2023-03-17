<?php

    namespace App\Http\Controllers\Backend\ImportExport;

    use App\Helpers\ExportHelper;
    use App\Http\Controllers\Controller;

    class ImportExportProductController extends Controller
    {
        public function __construct()
        {
            parent::__construct();

            $this->middleware('permission:list import export products', ['only' => ['index']]);
        }

        public function index()
        {
            return view('backend.import-export.products', [
                'permission'       => 'list import export products',
                'columnsForExport' => ExportHelper::getProductHeadings(),
            ]);
        }
    }
