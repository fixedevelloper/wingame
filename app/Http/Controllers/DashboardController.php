<?php


namespace App\Http\Controllers;


use App\Models\GamePlay;
use App\Models\LottoFixture;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function dashboard(Request $request)
    {
        $id=Session::get("id_connect");
        $user=User::query()->find($id);
        $address=Session::get("address_connect");
        return view('account.dashboard', [
            "address"=>$address,
            "id"=>$id,
            'route'=>"dashboard"
        ]);
    }
    public function settings(Request $request)
    {
        $address=Session::get("address_connect");
        return view('account.settings', [
            "address"=>$address,
            'route'=>"settings"
        ]);
    }
    public function bonus(Request $request)
    {
        $address=Session::get("address_connect");
        return view('account.bonus', [
            "address"=>$address,
            'route'=>"bonus"
        ]);
    }
    public function deposit(Request $request)
    {
        $user=Auth::user();
        if ($request->method()=="POST"){
            $user->activate=true;
            $user->save();
            return redirect()->route('dashboard');
        }
        return view('account.deposit', [
            'route'=>"deposit",
            "user"=>$user
        ]);

    }
    public function withdraw(Request $request)
    {
        return view('account.withdraw', [
            'route'=>"withdraw"
        ]);
    }
    public function transaction(Request $request)
    {
        return view('account.transaction', [
            'route'=>"transaction"
        ]);
    }
    public function myGame(Request $request)
    {
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->addDays(1)->format("y-m-d h:i");
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->addDays(1)->format("y-m-d h:i");
        }
        $address=Session::get("address_connect");
        $user=User::query()->firstWhere(['address'=>$address]);
        $mygames=GamePlay::query()->where(['user_id'=>$user->id])->whereBetween('created_at',[$date_,$timestamp])->get();
        return view('account.mygame', [
            "address"=>$address,
            'mygames'=>$mygames,
            'route'=>"mygame",
            'date'=>$date_
        ]);
    }
    public function identity(Request $request)
    {
        $address=Session::get("address_connect");
        return view('account.identity', [
            "address"=>$address,
            'route'=>"dashboard"
        ]);
    }
    public function logout(Request $request)
    {
        Session::remove("address_connect");
        Session::remove("id_connect");
        return redirect("/");
    }
}
