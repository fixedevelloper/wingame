<?php


namespace App\Http\Controllers;


use App\Helpers\Helpers;
use App\Models\Country;
use App\Models\ExactScoreFixture;
use App\Models\Fixture;
use App\Models\GamePlay;
use App\Models\League;
use App\Models\LottoFixture;
use App\Models\LottoFixtureItem;
use App\Models\OverFixture;
use App\Models\PlayingFixture;
use App\Models\Team;
use App\Models\User;
use App\Services\FootballAPIService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->getTimestamp();
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->getTimestamp();
        }
       // $data = LottoFixture::query()->orderByDesc('id')->limit(5)->get();
        return view('home', [
            "lotto_fixtures" => [],
            'date' => $date_
        ]);
    }
    public function over5_5(Request $request)
    {
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->getTimestamp();
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->getTimestamp();
        }
         $data = OverFixture::query()->where(['over_type'=>"OVER_55",'date'=>$date_])->orderByDesc('id')->paginate(20)->appends(['date'=>$date_]);
        return view('over.over55', [
            "fixtures" => $data,
            'date' => $date_
        ]);
    }
    public function over6_5(Request $request)
    {
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->getTimestamp();
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->getTimestamp();
        }
        $data = OverFixture::query()->where(['over_type'=>"OVER_65",'date'=>$date_])->orderByDesc('id')->paginate(20)->appends(['date'=>$date_]);
        return view('over.over65', [
            "fixtures" => $data,
            'date' => $date_
        ]);
    }
    public function over7_5(Request $request)
    {
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->getTimestamp();
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->getTimestamp();
        }
        $data = OverFixture::query()->where(['over_type'=>"OVER_75",'date'=>$date_])->orderByDesc('id')->paginate(20)->appends(['date'=>$date_]);
        return view('over.over75', [
            "fixtures" => $data,
            'date' => $date_
        ]);
    }
    public function over8_5(Request $request)
    {
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->getTimestamp();
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->getTimestamp();
        }
        $data = OverFixture::query()->where(['over_type'=>"OVER_85",'date'=>$date_])->orderByDesc('id')->paginate(20)->appends(['date'=>$date_]);
        return view('over.over85', [
            "fixtures" => $data,
            'date' => $date_
        ]);
    }
    public function exactscore(Request $request)
    {
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->getTimestamp();
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->getTimestamp();
        }
        $data = ExactScoreFixture::query()->where(['date'=>$date_])->orderByDesc('id')->paginate(20)->appends(['date'=>$date_]);
        return view('over.exactscore', [
            "fixtures" => $data,
            'date' => $date_
        ]);
    }
   /* public function home(Request $request)
    {
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->getTimestamp();
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->getTimestamp();
        }
        $data = LottoFixture::query()->orderByDesc('id')->limit(5)->get();
        return view('home', [
            "lotto_fixtures" => $data,
            'date' => $date_
        ]);
    }*/
    public function game(Request $request,$id)
    {
        $user=Auth::user();
        $lotto=LottoFixture::find($id);

        if (is_null($lotto)){
            return redirect("/");
        }
        $is_then=0;
        $data = LottoFixtureItem::query()->where(['lotto_fixture_id'=>$id])->get();
        $now=new DateTime('now',new \DateTimeZone("Africa/Brazzaville"));
        $interval=new DateTime($lotto->end_time);
        logger( $now->format("Y-m-d H:m"));
        logger( $interval->format("Y-m-d H:i"));
        if ($now->format("Y-m-d H:i")>$interval->format("Y-m-d H:i")){
            $is_then=1;
        }
        logger($is_then);
        return view('game', [
            "fixtures" => $data,
            "user"=>$user,
            "lotto"=>$lotto,
            "is_then"=>$is_then
        ]);

    }
    public function resultat(Request $request,$id)
    {
        $address=Session::get("address_connect");
        $lotto=LottoFixture::find($id);
        $data = LottoFixtureItem::query()->where(['lotto_fixture_id'=>$id])->get();
        $is_then= Carbon::parse($lotto->end_date)->diffInMinutes(Carbon::today())>0;
        logger($lotto->end_date);
        return view('resultat', [
            "fixtures" => $data,
            "address"=>$address,
            "lotto"=>$lotto,
            "is_then"=>$is_then
        ]);

    }

    public function login(){
        return view('login.login', []);
    }
    public function register(Request $request){
        $isLogged=false;
        $id= $request->get("txd");
        return view('register', [
            "id"=>$id,
        ]);
    }
    function register_ajax(Request $request){
        $user=new User();
        $user->name=$request->get("id");
        $user->id_contract=$request->get("id");
        $user->address=$request->get("address");
        $user->parain_address=$request->get("address_parent");
        $user->save();
        return response()->json(['data' =>  $user, 'status'=> true]);
    }
    function check_register(Request $request){
        $is_in=false;
        $address=$request->get("address");
        $user=User::query()->firstWhere(['address'=>$address]);
        if (!is_null($user)){
            $is_in=true;
        }
        return response()->json(['is_in' =>  $is_in, 'status'=> true]);
    }
    function login_next(Request $request){
        $id=$request->get("id");
        $address=$request->get("address");
        $user=User::query()->firstWhere(['address'=>$address]);
        if (!is_null($user)){
            if (is_null($user->id_contract)){
                $user->id_contract=$request->get("id");
                $user->save();
            }
            Session::put("id_connect",$id);
            Session::put("address_connect",$address);
            return response()->json(['data' =>  [], 'status'=> 200],200);
        }else{
            return response()->json(['data' =>  [], 'status'=> 405],405);
        }


    }
    public function postConbinaison(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $ob = $data['ob'];
        $loto_fixture=new LottoFixture();
        $loto_fixture->title=$data['title'];
        $end_time=$data['end_date'].' '.$data['end_time'];
        $loto_fixture->end_time=new \DateTime($end_time);
        $loto_fixture->save();

        for ($i = 0; $i < sizeof($ob); ++$i) {
            $item=new LottoFixtureItem();
            $item->fixture_id=$ob[$i]['id'];
            $item->lotto_fixture_id=$loto_fixture->id;
            $item->save();
        }
        return response()->json($ob);

    }
    public function postGame(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $ob = $data['ob'];
        $user=Auth::user();
        if (is_null($user)){
            return response("User not logged",403);
        }
        if ($user->sold<env("PRICE_GAME")){
            return response("Amount not set",403);
        }
        $game=new GamePlay();
        $game->user_id=$user->id;
        $game->lotto_fixture_id=$data['lotto_fixture_id'];
        $game->save();

        for ($i = 0; $i < sizeof($ob); ++$i) {
            $item=new PlayingFixture();
            $item->value=$ob[$i]['value'];
            $item->game_play_id=$game->id;
            $item->loto_fixture_item_id=$ob[$i]['id'];
            $item->save();
        }
        $user->sold-=env("PRICE_GAME");
        $user->save();
        return response()->json($ob);
    }
    public function getTeams(Request $request)
    {
        $data = json_decode($request->all(), true);
        $ob = $data['ob'];
        return response()->json($ob);

    }
    public function getBalance(Request $request)
    {
        $balance = $request->get("balance");
        Session::put("balance",$balance);
        return response()->json($balance);

    }
}
