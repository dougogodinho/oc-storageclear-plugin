<?php namespace Genius\StorageClear\Console;

use Storage;
use Illuminate\Console\Command;
use System\Models\File;

class StorageDumpProject extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'storage:dump-project';

    /**
     * @var string The console command description.
     */
    protected $description = 'Generate a ZIP file of your project only.';

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {
        $this->info(trans('genius.storageclear::lang.project.cleaning'));

        $this->callSilent('storage:clear');
        $this->callSilent('cache:clear');
        $this->callSilent('optimize');

        $this->info(trans('genius.storageclear::lang.project.start'));

        $file = base_path('__dump-' . date('Y-m-d-H-i-s') . '.zip');

        shell_exec("zip -rq '$file' . -x '*.DS_Store' -x '__*' -x '.idea' -x '.idea/*' -x '.env'");

        $this->info(trans('genius.storageclear::lang.project.end', compact('file')));
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
