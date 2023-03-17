<?php

    namespace App\Helpers;

    use App\Models\Client\Client;
    use App\Models\Product\Product;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Collection;
    use Schema;
    use Setting;

    class ExportHelper
    {
        public static function getProductHeadings(): Collection
        {
            return self::getColumnListForModel(new Product)->merge(
                [
                    'pages',
                    'filter_values',
                    'warranties',
                    'productRelations',
                ]
            );
        }

        public static function getClientHeadings()
        {
            return self::getColumnListForModel(new Client)->merge(
                [
                    'addresses',
                    'orders',
                ]
            );
        }

        public static function getColumnListForModel(Model $model): Collection
        {
            $columnList = collect(Schema::getColumnListing($model->getTable()));
            $columnList->forget(
                [
                    $columnList->search('deleted_at'),
                    $columnList->search('original_price'),
                    $columnList->search('original_price_old'),
                ]
            );

            if (is_array($model->translatedAttributes)) {
                $columnList = $columnList->merge(self::getTranslationColumns($model->translatedAttributes));
            }

            return $columnList;
        }

        public static function getTranslationColumns(array $translatedAttributes): Collection
        {
            $locales = Setting::get('locales', []);
            $columns = collect();

            foreach ($translatedAttributes as $translatedAttribute) {
                foreach ($locales as $lang => $locale) {
                    $columns->push($translatedAttribute . config('app.separators.export.header_local_column') . $lang);
                }
            }

            return $columns;
        }
    }
