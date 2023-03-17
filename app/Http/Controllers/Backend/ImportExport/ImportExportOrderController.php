<?php

    namespace App\Http\Controllers\Backend\ImportExport;

    use App\Http\Controllers\Controller;
    use App\Models\Order\Order;
    use Rap2hpoutre\FastExcel\Facades\FastExcel;

    class ImportExportOrderController extends Controller
    {
        public function __construct()
        {
            parent::__construct();

            $this->middleware('permission:list import export orders', ['only' => ['index']]);
        }

        public function index()
        {
            return view('backend.import-export.orders', [
                'permission' => 'list import export orders',
            ]);
        }

        public function export()
        {
            if (Order::count() > 0) {
                return FastExcel::data(Order::all())->download(collect([time(), 'orders.xlsx'])->implode('-'));
            }

            return $this->redirect('info', ['text' => __('backend.orders_not_found')]);
        }
    }
