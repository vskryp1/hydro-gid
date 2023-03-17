<?php

    namespace App\Helpers;

    use Illuminate\Http\UploadedFile;
    use Illuminate\Support\Collection;
    use Illuminate\Support\Facades\Storage;
    use Maatwebsite\Excel\HeadingRowImport;

    class ImportHelper
    {
        public static function clearOldImportFiles($fileNamePrefix): void
        {
            $oldFiles = glob(storage_path('app' . '/' . $fileNamePrefix . '*'));

            if (is_array($oldFiles)) {
                foreach ($oldFiles as $oldFile) {
                    Storage::delete(basename($oldFile));
                }
            }
        }

        public static function moveImportFile(UploadedFile $file, string $name): void
        {
            $file->move(self::getDirectory(), $name);
        }

        public static function getDirectory($path = 'app')
        {
            return storage_path($path);
        }

        public static function getHeadersFromFile(string $filePath): Collection
        {
            return collect((new HeadingRowImport)->toArray($filePath)[0][0])->filter();
        }

        public static function headerMapping(Collection $headers, Collection $headersFromFile): array
        {
            $relatives       = collect();
            $unRelatives     = collect();
            $headersFromFile = $headersFromFile->filter();

            foreach ($headers as $header) {
                $key = $headersFromFile->search($header);

                if (false !== $key) {
                    $relatives->push($headersFromFile->get($key));
                    $unRelatives->push('');
                } else {
                    $relatives->push('');
                }
            }

            return [
                'relatives'   => $relatives,
                'unRelatives' => $headersFromFile->diff($relatives)->merge($unRelatives)->filter(),
            ];
        }
    }
