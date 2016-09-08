<?php namespace Genius\StorageClear\Console;

use Storage;
use Illuminate\Console\Command;
use System\Models\File;

class StorageDump extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'storage:dump';

    /**
     * @var string The console command description.
     */
    protected $description = 'Generate backup files (.zip and .sql) of your project and database.';

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {
        $this->call('storage:dump-project');
        $this->call('storage:dump-database');
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
