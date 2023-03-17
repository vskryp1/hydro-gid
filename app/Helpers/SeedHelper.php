<?php

    namespace App\Helpers;

    use App\Models\Page\Page;

    class SeedHelper
    {
        public static function createAddFieldValue($page, $field, $file, $path = 'content/')
        {
            $page->additional_field_values()->create([
                'page_additional_field_id' => $field->id,
                'ru'                       => [
                    'value' => $file,
                ],
            ]);
            self::copyFile($page->id, $file, Page::GALLERY_PATH, $path);
        }

        public static function copyFile($id, $file, $gallery, $path = 'content/')
        {
            $from = resource_path('assets/frontend/images/' . $path . $file);
            $to   = storage_path('app/public/' . $gallery . $id . '/');
            if (file_exists($from)) {
                if (!is_dir($to)) {
                    mkdir($to, 0777, true);
                }
                copy($from, $to . $file);
            }
        }
    }
