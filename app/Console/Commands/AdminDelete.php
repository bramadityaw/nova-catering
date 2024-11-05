<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:delete {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an admin by name';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        try {
            $user = User::where('name', $name)->firstOrFail();
        } catch (ModelNotFoundException){
            $this->error("User '$name' not found!");
            return;
        }
        $user->delete();
        $this->info("User '$name' deleted successfully");
    }
}
