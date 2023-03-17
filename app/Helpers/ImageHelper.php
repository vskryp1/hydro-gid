<?php

    namespace App\Helpers;

    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    class ImageHelper
    {
        const SEPARATOR = '-';

        public static function generateName($path, $filename, $disk = 'public')
        {
            $name = explode('.', $filename);
            $ext  = end($name);
            unset($name[count($name) - 1]);
            $name = implode(self::SEPARATOR, $name);
            $name = self::transformName($name);
            $name = self::checkName($path, $name, $disk);

            return $name . '.' . $ext;
        }

        public static function transformName($title, $language = 'en')
        {
            $title = $language ? Str::ascii($title, $language) : $title;

            // Convert all dashes/underscores into separator
            $flip = self::SEPARATOR === '-' ? '_' : '-';

            $title = preg_replace('![' . preg_quote($flip) . ']+!u', self::SEPARATOR, $title);

            // Replace @ with the word 'at'
            $title = str_replace('@', self::SEPARATOR . 'at' . self::SEPARATOR, $title);

            // Remove all characters that are not the separator, letters, numbers, or whitespace.
            $title = preg_replace('![^' . preg_quote(self::SEPARATOR) . '\pL\pN\s]+!u', '', mb_strtolower($title));

            // Replace all separator characters and whitespace by a single separator
            $title = preg_replace('![' . preg_quote(self::SEPARATOR) . '\s]+!u', self::SEPARATOR, $title);

            //remove - from end alias
            $title = preg_replace('!(.+)' . preg_quote('-') . '$!u', '', $title);

            //remove - from start alias
            $title = preg_replace('!^' . preg_quote('-') . '(.+)!u', '', $title);

            return trim($title, self::SEPARATOR);
        }

        public static function checkName($path, $name, $disk = 'public')
        {
            $setNewName  = false;
            $separated   = $name . self::SEPARATOR;
            $existsNames = Storage::disk($disk)->files($path);

            if ($existsNames) {
                $num   = 0;
                $start = strlen($separated);

                foreach ($existsNames as $file) {
                    $file       = explode('.', basename($file));
                    $setNewName = $setNewName || $name == $file[0];
                    $rowNum     = substr($file[0], $start);

                    if (($name == $file[0] && $num == false) || (is_numeric($rowNum) && $rowNum > $num)) {
                        $num        = $rowNum;
                        $newName    = $separated . ($num + 1);
                        $setNewName = true;
                    }
                }
            }

            return $setNewName ? $newName : $name;
        }
    }
