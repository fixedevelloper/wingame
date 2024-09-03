<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use App\Services\PaymentApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MakeStatus extends Command
{
    protected $paymentApiService;

    /**
     * HomeController constructor.
     * @param $paymentApiService
     */
    public function __construct(PaymentApiService $paymentApiService)
    {
        $this->paymentApiService = $paymentApiService;
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-status';

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
        $operations=Transaction::query()->where(['status'=>"pending"])->get();
        logger($operations);
        foreach ($operations as $operation) {
            $rest=$this->paymentApiService->getPayID([
                'transactionId'=>$operation->idproof,
            ]);
            if (isset($rest['id'])){
                if ($rest['status']=="Success"){
                    if ($operation->status!="success"){
                        DB::beginTransaction();
                        $user=User::query()->find($operation->idproof);
                        $user->sold+=$operation->amount;
                        $operation->status="success";
                        $operation->save();
                        $user->save();
                        DB::commit();
                    }
                }
            }
        }

    }
}
