<?php namespace Genius\StorageClear\Console;

use Storage;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
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
        // início
        $this->info('--');

        // deletar arquivos que não tem registro
        $this->info('Buscando Arquivos não registrados...');

        $allFiles = Storage::allFiles('uploads');
        $count = 0;
        $total = count($allFiles);
        foreach ($allFiles as $file) {

            if (!File::where('disk_name', basename($file))->first(['id'])) {
                Storage::delete($file);
                $count++;
            }
        }
        $this->info('... ' . $count . ' arquivos removidos de ' . $total . ' encontrados!');



        // deletar registros que não tem arquivos
        $this->info('Buscando registros sem Arquivos ou sem Model relacionado...');

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
        $this->info('... ' . $count . ' registros removidos de ' . $total . ' encontrados!');


        // deletar pastas vazias
        $this->info('Buscando pastas vazias...');

        $allFolders = array_reverse(Storage::allDirectories('uploads'));
        $count = 0;
        $total = count($allFolders);
        foreach ($allFolders as $directory) {

            if (!Storage::allFiles($directory)) {
                Storage::deleteDirectory($directory);
                $count++;
            }
        }
        $this->info('... ' . $count . ' pastas vazias removidas de ' . $total . ' encontradas!');

        // fim
        $this->info('--');
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