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


    class ProductPriceImport implements ShouldQueue, WithHeadingRow, WithBatchInserts, ToModel, WithChunkReading
    {
        use Importable;


        public function model(array $row)
        {
            return $row;
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
