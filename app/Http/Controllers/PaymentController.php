<?php


namespace App\Http\Controllers;


use App\Helpers\Helpers;
use App\Models\Transaction;
use App\Services\PaydunyaService;
use App\Services\StripeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
                logger($resp);
                $link=$resp['url'];
                $transaction->method =$resp['token'];
                return redirect($link);
            }
            if ($type=="stripe"){
                $id=  $this->stripeService->payment_process_3d($request->amount,$transaction->id);
                return redirect($id['id']);

            }
            if ($type=="mobil"){
                return redirect()->route('upload_proof');

            }
        }

        return view('ticket.payemnt', [

        ]);
    }
    public function upload_proof(Request $request)
    {
        if ($request->method()=="POST"){

        }

        return view('ticket.proof', [

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
    public function calculPrice(Request $request)
    {
        if (is_null($request->get('number_type'))) {
            return response()->json(['data' => "", 'status' => 403]);
        }
        Session::put('number_type', $request->get('pay_type'));
        if ($request->pay_type=='day'){
            $amount=$request->number_type*50;
        }else{
            $amount=($request->number_type*50)*30;
        }

        return response()->json(['amount' => $amount, 'status' => 200]);
    }
}
