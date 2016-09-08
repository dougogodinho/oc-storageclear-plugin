<?php namespace Genius\StorageClear\Console;

use Storage;
use Illuminate\Console\Command;
use System\Models\File;

class StorageClear extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'storage:clear';

    /**
     * @var string The console command description.
     */
    protected $description = 'Scan and clear the storage folder.';

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {
        // remove files without related register...
        $this->info(trans('genius.storageclear::lang.clear.seeking.files'));

        $allFiles = Storage::allFiles('uploads');
        $count = 0;
        $total = count($allFiles);
        foreach ($allFiles as $file) {

            if (!File::where('disk_name', basename($file))->first(['id'])) {
                Storage::delete($file);
                $count++;
            }
        }
        $this->info(trans('genius.storageclear::lang.clear.removed.files', compact('count', 'total')));

        // remove registers without file...
        $this->info(trans('genius.storageclear::lang.clear.seeking.registers'));

        $allFiles = File::all(['id', 'disk_name', 'attachment_type', 'attachment_id', 'is_public']);
        $count = 0;
        $total = $allFiles->count();

        foreach ($allFiles as $file) {

            if (!Storage::exists($file->getDiskPath())) {

                $file->delete();
                $count++;
            } else {
                $class = $file->attachment_type;
                if (!$class || !class_exists($class) || !$class::find($file->attachment_id)) {

                    $file->delete();
                    $count++;
                }
            }

        }
        $this->info(trans('genius.storageclear::lang.clear.removed.registers', compact('count', 'total')));


        // deletar pastas vazias
        $this->info(trans('genius.storageclear::lang.clear.seeking.directories'));

        $allFolders = array_reverse(Storage::allDirectories('uploads'));
        $count = 0;
        $total = count($allFolders);
        foreach ($allFolders as $directory) {

            if (!Storage::allFiles($directory)) {
                Storage::deleteDirectory($directory);
                $count++;
            }
        }
        $this->info(trans('genius.storageclear::lang.clear.removed.directories', compact('count', 'total')));
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

}
