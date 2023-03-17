<?php

    namespace App\Imports;

    use Illuminate\Contracts\Queue\ShouldQueue;
    use Maatwebsite\Excel\Concerns\{
        ToModel,
        Importable,
        WithBatchInserts,
        WithChunkReading,
        WithHeadingRow};
    use App\Models\Product\Product;
    use App\Imports\Updater\ProductUpdater;


    class ProductImport implements ShouldQueue, WithHeadingRow, WithBatchInserts, ToModel, WithChunkReading
    {
        use Importable;

        private $headers;

        private $relative;

        public function __construct($headers, $relative)
        {
            $this->headers  = $headers;
            $this->relative = $relative;
        }

        public function model(array $row)
        {
            $updater   = new ProductUpdater($this->headers, $this->relative);
            $row['id'] = isset($row['id']) && $row['id'] != '' ? $row['id'] : null;
            $product   = Product::withTrashed()->firstOrNew(['id' => $row['id']]);
            $updater->update($product, $row);

            return null;
        }

        public function batchSize(): int
        {
            return 250;
        }

        public function chunkSize(): int
        {
            return 250;
        }
    }
