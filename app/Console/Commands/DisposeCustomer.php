<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;

class DisposeCustomer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dispose-customer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $operations=User::query()->where('last_sold','>','0')->get();
        foreach ($operations as $operation){
            $operation->last_sold=0;
            $operation->sold-=500;
            $operation->save();
        }
    }
}
