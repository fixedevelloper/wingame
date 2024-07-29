<?php


namespace App\Http\Controllers;


use App\Helpers\Helpers;
use App\Models\Transaction;
use App\Services\PaydunyaService;
use App\Services\StripeService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paydunyaService;
    private $stripeService;

    /**
     * PaymentController constructor.
     * @param $paydunyaService
     * @param $stripeService
     */
    public function __construct(PaydunyaService $paydunyaService, StripeService $stripeService)
    {
        $this->paydunyaService = $paydunyaService;
        $this->stripeService = $stripeService;
    }


    public function init(Request $request)
    {
        if ($request->method()=="POST"){
            $type=$request->type;
            $transaction=new Transaction();
            $transaction->type=$type;
            $transaction->amount=$request->amount;
            $transaction->user_id=$request->user_id;
            $transaction->save();
            if ($type=="paydunya"){
                $resp=  $this->paydunyaService->make_payment([
                'amount'=>$request->amount,
                    'phone'=>$transaction->user->phone,
                    'order_key'=>Helpers::generatenumber(),
                ]);
                $link=$resp['url'];
                $transaction->method =$resp['token'];
                return redirect($link);
            }
            if ($type=="stripe"){
              $id=  $this->stripeService->payment_process_3d($request->amount,$transaction->id);
              return redirect($id['id']);

            }
        }

        return view('ticket.init', [
            'user_id'=>$request->user_id
        ]);
    }
    public function finish(Request $request)
    {
        if ($request->method()=="POST"){
            $type=$request->type;
            $transaction=new Transaction();
            $transaction->type=$type;
            $transaction->amount=$request->amount;
            $transaction->user_id=$request->user_id;
            $transaction->save();
            if ($type=="paydunya"){
                $resp=  $this->paydunyaService->make_payment([
                    'amount'=>$request->amount,
                    'phone'=>$transaction->user->phone,
                    'order_key'=>Helpers::generatenumber(),
                ]);
                $link=$resp['url'];
                $transaction->method =$resp['token'];
                return redirect($link);
            }
            if ($type=="stripe"){
                $id=  $this->stripeService->payment_process_3d($request->amount,$transaction->id);
                return redirect($id['id']);

            }
        }

        return view('ticket.payemnt', [

        ]);
    }
    public function stripe_success(Request $request)
    {

        return view('ticket.payemnt', [

        ]);
    }
    public function stripe_echec(Request $request)
    {

        return view('ticket.payemnt', [

        ]);
    }
}
