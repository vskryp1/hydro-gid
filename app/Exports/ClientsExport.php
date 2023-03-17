<?php

    namespace App\Exports;

    use App\Models\Client\Client;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Maatwebsite\Excel\Concerns\Exportable;
    use Maatwebsite\Excel\Concerns\FromQuery;
    use Maatwebsite\Excel\Concerns\WithHeadings;

    class ClientsExport implements FromQuery, ShouldQueue, WithHeadings
    {
        use Exportable;

        public function query()
        {
            return Client::query();
        }

        public function headings(): array
        {
            $item = $this->query()->first();

            return array_keys($item->attributesToArray());
        }
    }
