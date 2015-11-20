<?php namespace Genius\StorageClear;

use System\Classes\PluginBase;

/**
 * StorageClear Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'genius.storageclear::lang.plugin.name',
            'description' => 'genius.storageclear::lang.plugin.description',
            'author'      => 'Genius',
            'icon'        => 'icon-recycle'
        ];
    }

    /**
     * Register events and more.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConsoleCommand('genius.storage:clear', 'Genius\StorageClear\Console\StorageClear');
    }


}
