<?php namespace Genius\StorageClear\Console;

use Storage;
use Illuminate\Console\Command;
use System\Models\File;

class StorageDumpDatabase extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'storage:dump-database';

    /**
     * @var string The console command description.
     */
    protected $description = 'Generate a dump file of your database only.';

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {

        $this->info(trans('genius.storageclear::lang.database.start'));

        $database = config('database.connections.' . config('database.default'));
        $file = base_path('__dump-' . date('Y-m-d-H-i-s') . '.sql');

        shell_exec('credentialsFile=' . uniqid() . '.cnf ' .
            ' && echo "[client]" > $credentialsFile ' .
            " && echo \"user={$database['username']}\" >> \$credentialsFile " .
            " && echo \"password={$database['password']}\" >> \$credentialsFile " .
            " && echo \"host={$database['host']}\" >> \$credentialsFile " .
            " && mysqldump --defaults-extra-file=\$credentialsFile {$database['database']} > '$file'" .
            " && rm \$credentialsFile");

        $this->info(trans('genius.storageclear::lang.database.end', compact('file')));
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
