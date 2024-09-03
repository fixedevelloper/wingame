<?php


namespace App\Http\Controllers;


use App\Helper\Helper;
use App\Helpers\Helpers;
use App\Models\Payment;
use App\Models\Transaction;
use App\Services\PaydunyaService;
use App\Services\PaymentApiService;
use App\Services\StripeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    private $paydunyaService;
    private $stripeService;
    protected $paymentApiService;

    /**
     * PaymentController constructor.
     * @param PaydunyaService $paydunyaService
     * @param StripeService $stripeService
     * @param PaymentApiService $paymentApiService
     */
    public function __construct(PaydunyaService $paydunyaService, StripeService $stripeService,PaymentApiService $paymentApiService)
    {
        $this->paydunyaService = $paydunyaService;
        $this->stripeService = $stripeService;
        $this->paymentApiService = $paymentApiService;
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
                return redirect()->route('upload_proof',['trans_id'=>$transaction->id]);

            }
        }

        return view('ticket.payemnt', [

        ]);
    }
    public function upload_proof(Request $request)
    {
        if ($request->method()=="POST"){
            $transaction=Transaction::query()->find($request->trans_id);
            $rest=$this->paymentApiService->payment([
                'phone'=>$request->phone,
                'amount'=>intval($transaction->amount),
                'country'=>$request->country,
                'carrier'=>$request->carrier
            ]);
            logger($rest);
            if ($rest['status']=='true'){
                $transaction->idproof=$rest['transactionId'];
                $transaction->save();
                Session::put('trans_ref',$rest['transactionId']);
                return redirect()->route('waiting_page',[]);
            }
        }

        return view('ticket.proof', [

        ]);
    }
    public function waiting_page(Request $request)
    {
        return view('ticket.waitingpayment', [

        ]);
    }
    public function stripe_success(Request $request)
    {
        $transaction=Transaction::query()->find($request->id);
        $transaction->status='accepted';
        $quantity=$transaction->amount/50;
        $user=$transaction->user;
        $date=Carbon::parse($user->expired)->addDays($quantity);
        $user->expired=$date;
        $user->save();
        $transaction->save();
        return view('ticket.payemnt', [

        ]);
    }
    public function stripe_echec(Request $request)
    {
        $transaction=Transaction::query()->find($request->id);
        $transaction->status='rejected';
        $transaction->save();
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
