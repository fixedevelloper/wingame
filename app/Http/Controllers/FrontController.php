<?php


namespace App\Http\Controllers;


use App\Helpers\Helpers;
use App\Models\Country;
use App\Models\ExactScoreFixture;
use App\Models\Fixture;
use App\Models\FixtureEvent;
use App\Models\GamePlay;
use App\Models\League;
use App\Models\LeagueDay;
use App\Models\LottoFixture;
use App\Models\LottoFixtureItem;
use App\Models\OverFixture;
use App\Models\PlayingFixture;
use App\Models\Team;
use App\Models\TeamEvent;
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
            $leagues=LeagueDay::query()->where(['day_timestamp' => $timestamp])->orderBy('league_id')->paginate(5)->appends(['date' => $date_]);

        return view('home', [
            'date' => $date_,
            'leagues' => $leagues
        ]);
    }

    public function detail_fixture(Request $request, $id)
    {
        $fixture = Fixture::query()->find($id);
        $dataLastHome = Fixture::query()->where(['team_home_id' => $fixture->team_home_id])
            ->where('day_timestamp', '<', $fixture->day_timestamp)->orderByDesc('date')->limit(5)->get();
        $dataLasAway = Fixture::query()->where(['team_away_id' => $fixture->team_away_id])
            ->where('day_timestamp', '<', $fixture->day_timestamp)->orderByDesc('date')->limit(5)->get();
        $dataH2H = Fixture::query()->where(['team_home_id' => $fixture->team_home_id, 'team_away_id' => $fixture->team_away_id])
            ->where('day_timestamp', '<', $fixture->day_timestamp)->orderByDesc('date')->limit(5)->get();
        $v_h = 0;
        $v_a = 0;
        $v_h_a = 0;
        $v_a_a = 0;
        $v_h_l = 0;
        $v_a_l = 0;
        $over_05 = 0;
        $over_15 = 0;
        $over_25 = 0;
        $over_35 = 0;
        $over_45 = 0;

        $over_05_a = 0;
        $over_15_a = 0;
        $over_25_a = 0;
        $over_35_a = 0;
        $over_45_a = 0;

        $over_05_l = 0;
        $over_15_l = 0;
        $over_25_l = 0;
        $over_35_l = 0;
        $over_45_l = 0;
        foreach ($dataH2H as $item) {
            if ($item->score_ft_home > $item->score_ft_away) {
                $v_h += 1;
            }
            if ($item->score_ft_home < $item->score_ft_away) {
                $v_a += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 0.5) {
                $over_05 += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 1.5) {
                $over_15 += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 2.5) {
                $over_25 += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 3.5) {
                $over_35 += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 4.5) {
                $over_45 += 1;
            }
        }
        foreach ($dataLastHome as $item) {
            if ($item->score_ft_home - $item->score_ft_away>0) {
                $v_h_l += 1;
            }
            if ($item->score_ft_home - $item->score_ft_away<0) {
                $v_a_l += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 0.5) {
                $over_05_l += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 1.5) {
                $over_15_l += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 2.5) {
                $over_25_l += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 3.5) {
                $over_35_l += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 4.5) {
                $over_45_l += 1;
            }
        }
        foreach ($dataLasAway as $item) {
            if ($item->score_ft_home - $item->score_ft_away>0) {
                $v_h_a += 1;
            }
            if ($item->score_ft_home - $item->score_ft_away<0) {
                $v_a_a += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 0.5) {
                $over_05_a += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 1.5) {
                $over_15_a += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 2.5) {
                $over_25_a += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 3.5) {
                $over_35_a += 1;
            }
            if (($item->score_ft_away + $item->score_ft_home) > 4.5) {
                $over_45_a += 1;
            }
        }
        return view('deatl_fixture', [
            "fixture" => $fixture,
            "over_05" => $over_05,
            "over_15" => $over_15,
            "over_25" => $over_25,
            "over_35" => $over_35,
            "over_45" => $over_45,
            "v_h" => $v_h,
            "v_a" => $v_a,
            "other" => sizeof($dataH2H) - ($v_a + $v_h),
            "response" => $dataH2H,
            'fixure_last_home' => $dataLastHome,
            'fixure_last_away' => $dataLasAway,
            "over_05_a" => $over_05_a,
            "over_15_a" => $over_15_a,
            "over_25_a" => $over_25_a,
            "over_35_a" => $over_35_a,
            "over_45_a" => $over_45_a,
            "v_h_a" => $v_h_a,
            "v_a_a" => $v_a_a,
            "other_a" => sizeof($dataLasAway) - ($v_a_a + $v_h_a),

            "over_05_l" => $over_05_l,
            "over_15_l" => $over_15_l,
            "over_25_l" => $over_25_l,
            "over_35_l" => $over_35_l,
            "over_45_l" => $over_45_l,
            "v_h_l" => $v_h_l,
            "v_a_l" => $v_a_l,
            "other_l" => sizeof($dataLastHome) - ($v_a_l + $v_h_l),

        ]);
    }

    public function fixture_lost(Request $request)
    {
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->getTimestamp();
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->getTimestamp();
        }
        $data=[];
        $leagues = FixtureEvent::query()->leftJoin('fixtures','fixtures.id','=','fixture_events.lt_fixture_id')
            ->where(['fixture_events.day_timestamp' => $timestamp,'team_position'=>"HOME"])
            ->orderByDesc('fixture_events.id')->select(['league_id'])->paginate(10);

        return view('fixtuerelosthome', [
            // "fixtures" => $fixts,
            'leagues'=>$leagues,
            'date' => $date_,
        ]);
    }
    public function fixture__away_lost(Request $request)
    {
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->getTimestamp();
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->getTimestamp();
        }
        $data=[];
/*        $fixts = FixtureEvent::query()->where(['day_timestamp' => $timestamp,'team_position'=>"AWAY"])
            ->orderByDesc('id')->paginate(20);*/
        $leagues = FixtureEvent::query()->leftJoin('fixtures','fixtures.id','=','fixture_events.lt_fixture_id')
            ->where(['fixture_events.day_timestamp' => $timestamp,'team_position'=>"AWAY"])
            ->orderByDesc('fixture_events.id')->select(['league_id'])->paginate(10);

        return view('fixtuerelosthome', [
           // "fixtures" => $fixts,
            'leagues'=>$leagues,
            'date' => $date_,
        ]);
    }
    public function detail_fixtureHTH(Request $request, $id)
    {
        $fixture = Fixture::query()->find($id);
        $dataH2H = FootballAPIService::getAllFixturesHtoH($fixture->team_home_id, $fixture->team_away_id);
        $response = $dataH2H->response;
        $v_h = 0;
        $v_a = 0;
        $over_05 = 0;
        $over_15 = 0;
        $over_25 = 0;
        $over_35 = 0;
        $over_45 = 0;
        for ($i = 0; $i < sizeof($response); $i++) {
            if ($response[$i]->teams->home->winner) {
                $v_h += 1;
            }
            if ($response[$i]->teams->away->winner) {
                $v_a += 1;
            }
            if (($response[$i]->goals->home + $response[$i]->goals->away) > 0.5) {
                $over_05 += 1;
            }
            if (($response[$i]->goals->home + $response[$i]->goals->away) > 1.5) {
                $over_15 += 1;
            }
            if (($response[$i]->goals->home + $response[$i]->goals->away) > 2.5) {
                $over_25 += 1;
            }
            if (($response[$i]->goals->home + $response[$i]->goals->away) > 3.5) {
                $over_35 += 1;
            }
            if (($response[$i]->goals->home + $response[$i]->goals->away) > 4.5) {
                $over_45 += 1;
            }
        }
        return view('deatl_fixture', [
            "fixture" => $fixture,
            "over_05" => $over_05,
            "over_15" => $over_15,
            "over_25" => $over_25,
            "over_35" => $over_35,
            "over_45" => $over_45,
            "v_h" => $v_h,
            "v_a" => $v_a,
            "other" => sizeof($response) - ($v_a + $v_h),
            "response" => $response

        ]);
    }
    public function detail_fixtureTeamLost(Request $request, $id)
    {
        $fixture = Fixture::query()->find($id);
        $team_id=$request->team;
        $fixtures=Fixture::query()->where(['team_home_id'=>$team_id])
            ->orWhere(['team_away_id'=>$team_id])
            ->where('day_timestamp','<',$fixture->day_timestamp)
            ->orderByDesc('fixture_id')->limit(5)->get();


        return view('detail_team', [
            "fixture" => $fixture,
            'team'=>Team::query()->find($team_id),
            'fixtures'=>$fixtures

        ]);
    }
    public function lastFixture_defeats(Request $request)
    {
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->getTimestamp();
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->getTimestamp();
        }
        $teams=TeamEvent::query()->where(['day_timestamp' => $timestamp,'last5_no_lost'=>true])->paginate(20);
        return view('lastfixture_defaits', [
            'date' => $date_,
            'teams' => $teams
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
        $data = OverFixture::query()->where(['over_type' => "OVER_55", 'date' => $date_])->orderByDesc('id')
            ->paginate(20)->appends(['date' => $date_]);
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
        $data = OverFixture::query()->where(['over_type' => "OVER_65", 'date' => $date_])->orderByDesc('id')->paginate(20)->appends(['date' => $date_]);
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
        $data = OverFixture::query()->where(['over_type' => "OVER_75", 'date' => $date_])->orderByDesc('id')->paginate(20)->appends(['date' => $date_]);
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
        $data = OverFixture::query()->where(['over_type' => "OVER_85", 'date' => $date_])->orderByDesc('id')->paginate(20)->appends(['date' => $date_]);
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
        $data = ExactScoreFixture::query()->where(['date' => $date_])->orderByDesc('id')->paginate(20)->appends(['date' => $date_]);
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
    public function game(Request $request, $id)
    {
        $user = Auth::user();
        $lotto = LottoFixture::find($id);

        if (is_null($lotto)) {
            return redirect("/");
        }
        $is_then = 0;
        $data = LottoFixtureItem::query()->where(['lotto_fixture_id' => $id])->get();
        $now = new DateTime('now', new \DateTimeZone("Africa/Brazzaville"));
        $interval = new DateTime($lotto->end_time);
        logger($now->format("Y-m-d H:m"));
        logger($interval->format("Y-m-d H:i"));
        if ($now->format("Y-m-d H:i") > $interval->format("Y-m-d H:i")) {
            $is_then = 1;
        }
        logger($is_then);
        return view('game', [
            "fixtures" => $data,
            "user" => $user,
            "lotto" => $lotto,
            "is_then" => $is_then
        ]);

    }

    public function resultat(Request $request, $id)
    {
        $address = Session::get("address_connect");
        $lotto = LottoFixture::find($id);
        $data = LottoFixtureItem::query()->where(['lotto_fixture_id' => $id])->get();
        $is_then = Carbon::parse($lotto->end_date)->diffInMinutes(Carbon::today()) > 0;
        logger($lotto->end_date);
        return view('resultat', [
            "fixtures" => $data,
            "address" => $address,
            "lotto" => $lotto,
            "is_then" => $is_then
        ]);

    }

    public function login()
    {
        return view('login.login', []);
    }

    public function register(Request $request)
    {
        $isLogged = false;
        $id = $request->get("txd");
        return view('register', [
            "id" => $id,
        ]);
    }

    function register_ajax(Request $request)
    {
        $user = new User();
        $user->name = $request->get("id");
        $user->id_contract = $request->get("id");
        $user->address = $request->get("address");
        $user->parain_address = $request->get("address_parent");
        $user->save();
        return response()->json(['data' => $user, 'status' => true]);
    }

    function check_register(Request $request)
    {
        $is_in = false;
        $address = $request->get("address");
        $user = User::query()->firstWhere(['address' => $address]);
        if (!is_null($user)) {
            $is_in = true;
        }
        return response()->json(['is_in' => $is_in, 'status' => true]);
    }

    function login_next(Request $request)
    {
        $id = $request->get("id");
        $address = $request->get("address");
        $user = User::query()->firstWhere(['address' => $address]);
        if (!is_null($user)) {
            if (is_null($user->id_contract)) {
                $user->id_contract = $request->get("id");
                $user->save();
            }
            Session::put("id_connect", $id);
            Session::put("address_connect", $address);
            return response()->json(['data' => [], 'status' => 200], 200);
        } else {
            return response()->json(['data' => [], 'status' => 405], 405);
        }


    }

    public function postConbinaison(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $ob = $data['ob'];
        $loto_fixture = new LottoFixture();
        $loto_fixture->title = $data['title'];
        $end_time = $data['end_date'] . ' ' . $data['end_time'];
        $loto_fixture->end_time = new \DateTime($end_time);
        $loto_fixture->save();

        for ($i = 0; $i < sizeof($ob); ++$i) {
            $item = new LottoFixtureItem();
            $item->fixture_id = $ob[$i]['id'];
            $item->lotto_fixture_id = $loto_fixture->id;
            $item->save();
        }
        return response()->json($ob);

    }

    public function postGame(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $ob = $data['ob'];
        $user = Auth::user();
        if (is_null($user)) {
            return response("User not logged", 403);
        }
        if ($user->sold < env("PRICE_GAME")) {
            return response("Amount not set", 403);
        }
        $game = new GamePlay();
        $game->user_id = $user->id;
        $game->lotto_fixture_id = $data['lotto_fixture_id'];
        $game->save();

        for ($i = 0; $i < sizeof($ob); ++$i) {
            $item = new PlayingFixture();
            $item->value = $ob[$i]['value'];
            $item->game_play_id = $game->id;
            $item->loto_fixture_item_id = $ob[$i]['id'];
            $item->save();
        }
        $user->sold -= env("PRICE_GAME");
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
        Session::put("balance", $balance);
        return response()->json($balance);

    }
    public function getFixture(Request $request)
    {
        $league_id = $request->get("id");
        $timestamp=$request->get('timestamp');
        //$timestamp = Carbon::parse($date_)->getTimestamp();
        $fixtures = Fixture::query()->where(['day_timestamp'=>$timestamp,'league_id'=>$league_id])
            ->orderByDesc('id')->get();
        $array=[];
        foreach ($fixtures as $fixture){
            $over=OverFixture::query()->firstWhere(['fixture_id'=>$fixture->fixture_id]);
            $array[]=[
                'score_ft_home'=>$fixture->score_ft_home,
                'score_ft_away'=>$fixture->score_ft_away,
                'id'=>$fixture->id,
                'team_home_logo'=>$fixture->team_home_logo,
                'team_home_name'=>$fixture->team_home_name,
                'team_away_logo'=>$fixture->team_away_logo,
                'team_away_name'=>$fixture->team_away_name,
                'odd_home'=>$over==null?'':$over->home,
                'odd_away'=>$over==null?'':$over->away,
                'odd_draw'=>$over==null?'':$over->draw,
                'variation_home'=>$over==null?'':round($over->variation_home,2),
                'variation_away'=>$over==null?'':round($over->variation_away,2),
                'variation_draw'=>$over==null?'':round($over->variation_home,2),
                'variation_home_st'=>$over==null?'': $over->home-$over->old_home,
                'variation_away_st'=>$over==null?'':$over->away-$over->old_away,
                'variation_draw_st'=>$over==null?'':$over->draw-$over->old_draw,
            ];
        }
        return response()->json($array);

    }
}
