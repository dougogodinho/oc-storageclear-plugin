<?php namespace Genius\StorageClear;

use Genius\StorageClear\Console\StorageClear;
use Genius\StorageClear\Console\StorageDump;
use Genius\StorageClear\Console\StorageDumpDatabase;
use Genius\StorageClear\Console\StorageDumpProject;
use System\Classes\PluginBase;

/**
 * StorageClear Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'genius.storageclear::lang.plugin.name',
            'description' => 'genius.storageclear::lang.plugin.description',
            'author' => 'Genius',
            'icon' => 'icon-recycle'
        ];
    }

    /**
     * Register events and more.
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommand('genius.storage:clear', StorageClear::class);
        $this->registerConsoleCommand('genius.storage:dump', StorageDump::class);
        $this->registerConsoleCommand('genius.storage:dump-project', StorageDumpProject::class);
        $this->registerConsoleCommand('genius.storage:dump-database', StorageDumpDatabase::class);
    }
}
