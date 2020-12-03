<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SortProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:sort';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

            \DB::update('UPDATE products SET sort = CONCAT( FLOOR(RAND()*10000), FLOOR(RAND()*10000))');
    }
}
