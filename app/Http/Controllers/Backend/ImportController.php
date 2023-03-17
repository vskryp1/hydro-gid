<?php

    namespace App\Http\Controllers\Backend;

    use App\Helpers\{ExportHelper, ImportHelper};
    use App\Imports\ProductImport;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Exception;

    class ImportController extends Controller
    {
        public function products(Request $request)
        {
            if ($request->has('fileName')) {
                (new ProductImport($request->input('header', []), $request->input('relative', [])))
                    ->queue(ImportHelper::getDirectory('app/' . $request->input('fileName')));

                return redirect()
                    ->route('backend.products.index', [], 301)
                    ->with('success', ['text' => __('backend.import_success')]);
            }

            return $this->redirect('info', ['text' => __('backend.something_went_wrong')]);
        }

        public function productHeaders(Request $request)
        {
            if (!$this->checkFileUpload($request, 'file')) {
                return $this->redirect('info', ['text' => __('backend.file_not_found')]);
            }

            $file           = $request->file('file');
            $fileNamePrefix = 'laravel-excel-';
            $fileName       = $fileNamePrefix . $file->getFilename() . '.' . $file->getClientOriginalExtension();

            try {
                ImportHelper::clearOldImportFiles($fileNamePrefix);
                ImportHelper::moveImportFile($file, $fileName);

                $headers = ExportHelper::getProductHeadings();

                [
                    'relatives'   => $relatives,
                    'unRelatives' => $unRelatives,
                ] = ImportHelper::headerMapping($headers, ImportHelper::getHeadersFromFile($fileName));

                return view('backend.import.fields', [
                    'permission'  => 'list import export products',
                    'headers'     => $headers,
                    'relatives'   => $relatives,
                    'unRelatives' => $unRelatives,
                    'fileName'    => $fileName,
                ]);
            } catch (Exception $exception) {
                return $this->redirect('info', ['text' => __('backend.something_went_wrong')]);
            }
        }

        private function checkFileUpload(Request $request, string $name): bool
        {
            return $request->hasFile($name) && $request->file($name)->isValid();
        }
    }
