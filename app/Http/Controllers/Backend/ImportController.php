<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\{ExportHelper, ImportHelper};
use App\Imports\ProductImport;
use App\Imports\ProductPriceImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Product\Product;

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

        $file = $request->file('file');
        $fileNamePrefix = 'laravel-excel-';
        $fileName = $fileNamePrefix . $file->getFilename() . '.' . $file->getClientOriginalExtension();

        try {
            ImportHelper::clearOldImportFiles($fileNamePrefix);
            ImportHelper::moveImportFile($file, $fileName);

            $headers = ExportHelper::getProductHeadings();

            [
                'relatives' => $relatives,
                'unRelatives' => $unRelatives,
            ] = ImportHelper::headerMapping($headers, ImportHelper::getHeadersFromFile($fileName));

            return view('backend.import.fields', [
                'permission' => 'list import export products',
                'headers' => $headers,
                'relatives' => $relatives,
                'unRelatives' => $unRelatives,
                'fileName' => $fileName,
            ]);
        } catch (Exception $exception) {
            return $this->redirect('info', ['text' => __('backend.something_went_wrong')]);
        }
    }

    private function checkFileUpload(Request $request, string $name): bool
    {
        return $request->hasFile($name) && $request->file($name)->isValid();
    }

    public function prices(Request $request)
    {
        if (!$this->checkFileUpload($request, 'file')) {
            return $this->redirect('info', ['text' => __('backend.file_not_found')]);
        }

        $rows = (new ProductPriceImport())->toArray($request->file('file'));

        foreach ($rows[0] as $row) {
            $sku = $row['Артикул'];
            $price = (double)str_replace(',','.',$row['Ціна роздрібна з ПДВ в євро']);
            Product::where('sku', 'LIKE', '%'.$sku.'%')->update(['original_price' => $price, 'original_price_old' => $price, 'price' => $price, 'price_old' => $price]);
        }

         return redirect()
             ->route('backend.products.index', [], 301)
             ->with('success', ['text' => __('backend.import_success')]);
    }
}
