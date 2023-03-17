<?php


    namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use App\Models\Client\Client;
    use App\Models\Product\Product;
    use App\Exports\{ClientsExport, Mappers\ProductMapper, ProductsExport};
    use App\QueryFilters\ProductsFilter;
    use Maatwebsite\Excel\Facades\Excel;

    class ExportController extends Controller
    {
        public function products(ProductsFilter $filter, ProductMapper $mapper)
        {
            if (Product::count() > 0) {
                return new ProductsExport($filter, $mapper);
            }

            return $this->redirect('info', ['text' => __('backend.products_not_found')]);
        }

        public function clients()
        {
            if (Client::count() > 0) {
                return Excel::download(new ClientsExport, 'clients.xlsx');
            }

            return $this->redirect('info', ['text' => __('backend.users_not_found')]);
        }
    }
