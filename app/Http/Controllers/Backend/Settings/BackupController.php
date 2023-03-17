<?php

    namespace App\Http\Controllers\Backend\Settings;

    use App\Helpers\BackupHelper;
    use File;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Setting;
    use Spatie\Backup\Helpers\Format;
    use Spatie\Backup\Tasks\Monitor\BackupDestinationStatus;
    use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;
    use Storage;

    class BackupController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->middleware('permission:services', ['only' => ['index']]);
        }

        public function index()
        {
            $backup_list = Storage::files(config('backup.backup.name'));

            return view('backend.services.index', [
                'backup_list' => $backup_list,
                'backups'     => Setting::get('backups', []),
            ]);
        }

        public function store(Request $request)
        {
            Setting::lang(null)->set('backups', $request->all());
            return redirect(route('backend.settings.backups.index'))->with('success', ['text' => __('backend.setting_saved')]);
        }

        public function download($number)
        {
            $backup_list = BackupHelper::getBackupFiles();
            return isset($backup_list[$number]) ? Storage::download($backup_list[$number]) : redirect(route('backend.settings.backups.index'))->with('danger', 'error');
        }

        public function make()
        {
            \Artisan::call('backup:run');
            BackupHelper::clearOldBackup();
            return redirect(route('backend.settings.backups.index'))->with('success', ['text' => __('backend.backup_success')]);
        }

        public function clear()
        {
//        \Artisan::call('backup:clean');
            $backup_list = BackupHelper::getBackupFiles();
            foreach ($backup_list as $number => $backup_one) {
                Storage::delete($backup_one);
            }
            return redirect(route('backend.settings.backups.index'))->with('success', ['text' => __('backend.backup_cleared')]);
        }
    }
