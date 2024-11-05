<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminNew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:new {name} {pass}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin through the command line';

    /**
     * Execute the console command.
     */
    public function handle() : void
    {
        $name = $this->argument('name');
        $pass = $this->argument('pass');

        try {
            DB::table('users')->insert([
            'name' => $name,
            'password' => Hash::make($pass),
            ]);
        } catch (\Exception) {
            $this->error('Failed to insert!');
            $this->line('Check your database connection');
            return;
        }

        $this->info("User '$name' created successfullly");
    }
}
