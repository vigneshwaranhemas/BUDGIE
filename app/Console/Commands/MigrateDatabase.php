<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
use DB;

class MigrateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_database:migrate';

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
     * @return int
     */
    public function handle()
    {
        Artisan::call('migrate:reset', ['--force' => true]);
        DB::unprepared(file_get_contents('database/ck_recruitment_management_demo.sql'));
        Artisan::call('migrate');
    }
}
