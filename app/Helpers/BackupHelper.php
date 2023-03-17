<?php

    namespace App\Helpers;

    use Setting;
    use Storage;

    class BackupHelper
    {
        static public function clearOldBackup()
        {
            $backup_list = self::getBackupFiles();
            $max_count   = Setting::get('backups.max_count', 7);

            if (count($backup_list) > $max_count) {
                for ($i = count($backup_list) - $max_count - 1; $i >= 0; $i--) {
                    Storage::delete($backup_list[$i]);
                }
            }
        }

        static public function getBackupFiles()
        {
            return Storage::files(config('backup.backup.name'));
        }
    }