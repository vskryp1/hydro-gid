<?php

    namespace App\Exports;

    use App\Exports\Mappers\ProductMapper;
    use App\Models\Product\Product;
    use App\QueryFilters\ProductsFilter;
    use Illuminate\Contracts\Support\Responsable;
    use Illuminate\Database\Eloquent\Builder;
    use Maatwebsite\Excel\Concerns\{WithHeadings, WithMapping, FromQuery, Exportable, ShouldAutoSize};
    use Maatwebsite\Excel\Excel;

    class ProductsExport implements FromQuery, WithMapping, WithHeadings, Responsable, ShouldAutoSize
    {
        use Exportable;

        private $filter;

        private $mapper;

        private $fileName = 'products.xlsx';

        private $writerType = Excel::XLSX;

        private $headers = [
            'Content-Type' => 'text/csv',
        ];

        public function __construct(ProductsFilter $filter, ProductMapper $mapper)
        {
            $this->filter = $filter;
            $this->mapper = $mapper;
        }

        public function query(): Builder
        {
            return Product::with('translations')->filter($this->filter)->byPosition();
        }

        public function headings(): array
        {
            return request('export_fields', []);
        }

        public function map($product): array
        {
            return $this->mapper->map($product);
        }
    }
