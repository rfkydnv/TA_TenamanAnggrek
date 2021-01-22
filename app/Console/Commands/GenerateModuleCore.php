<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateModuleCore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:make-modules {module_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Modules Custom Core';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        Artisan::call('module:make',[
            'name' => [$this->argument('module_name')],
            '-p' => true
        ]);

        Artisan::call('module:make-controller',[
            'controller' => $this->argument('module_name').'Controller',
            'module' => $this->argument('module_name'),
        ]);
    }
}
