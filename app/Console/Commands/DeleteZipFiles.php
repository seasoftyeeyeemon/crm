<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteZipFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:zips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete zip file when file is over 72 hours';

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
        $zip = \DB::table('csv_lists')->delete();
        $zip_from_files=public_path('zip/*');
        
        
    }
}
