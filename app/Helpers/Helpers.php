<?php


namespace App\Helpers;


use App\Models\Fixture;
use App\Models\FixtureEvent;
use App\Models\GamePlay;
use App\Models\League;
use App\Models\LottoFixtureItem;
use App\Models\Odd;
use App\Models\OverFixture;
use App\Models\PlayingFixture;
use App\Models\Stadings;
use App\Models\Team;
use Carbon\Carbon;

class Helpers
{
    public static function generatenumber()
    {
        $tabs=['1','2','3','4','5','6','7','8','9','0'];
        $strong=date("ymds");
        for ($i = 1; $i <= 15; $i++) {
            $strong .= $tabs[rand(0, count($tabs) - 1)];
        }
        return $strong;
    }
    static function leftTime($date){

    }
    static function odd($fixture_id)
    {
        $odd = OverFixture::query()->firstWhere(['fixture_id' => $fixture_id]);
        return $odd;
    }

    static function makeTime($fixture)
    {
        $today = date('y-m-d');
        $today_timestamp = Carbon::parse($today)->getTimestamp();
        if ($today_timestamp == $fixture->day_timestamp) {
            if ($fixture->st_short == "NS") {
                return "Today/" . Carbon::parse($fixture->date)->format('h:i:s');
            } elseif ($fixture->st_short == "FT") {
                return "FT";
            } else {
                return $fixture->st_short;
            }
        } else {
            return $fixture->st_short;
        }

    }



    static function teamFormArray($form)
    {
        $arrays = str_split($form);
        return $arrays;
    }

    static function fixtureOfDayByLeague($league, $time)
    {
        $fixtures = Fixture::query()->where(['league_id' => $league, 'day_timestamp' => $time])->get();
        return $fixtures;
    }

    static function getTeamByID($team_id)
    {
        $team = Team::query()->firstWhere(['team_id' => $team_id]);
        return [
            'name' => is_null($team) ? "" : $team->name,
            'logo' => is_null($team) ? "" : $team->logo,
            'country' => is_null($team) ? "" : $team->country,
        ];
    }
    static function getTeamBy($team_id)
    {
        $team = Team::query()->firstWhere(['team_id' => $team_id]);
        return [
            'name' => is_null($team) ? "" : $team->name,
            'logo' => is_null($team) ? "" : $team->logo,
        ];
    }
    static function getFixture($fixture_id)
    {
        $fixture=Fixture::query()->firstWhere(['fixture_id'=>$fixture_id]);

        return $fixture;
    }
    static function getLottofixtureItem($fixture_id)
    {
        $fixtures=LottoFixtureItem::query()->where(['lotto_fixture_id'=>$fixture_id])->get();
        return $fixtures;
    }
    static function getTeamNoLostLast5($team_id,$timestamp)
    {
        $fixtures=Fixture::query()->where(['team_home_id'=>$team_id])
            ->orWhere(['team_away_id'=>$team_id])->where('day_timestamp','<',$timestamp)->orderByDesc('fixture_id')->limit(5)->get();
        $count=0;
        foreach ($fixtures as $item){
            if ($item->team_away_id==$team_id && $item->team_home_winner==false){
               $count++;
            }
            if ($item->team_home_id==$team_id && $item->team_home_winner==false){
                $count++;
            }
        }
        if ($count>=5){
            return true;
        }else{
            return false;
        }
    }
    static function getFixtureByLeague($league_id,$date_)
    {
        $timestamp = Carbon::parse($date_)->getTimestamp();
        $data = Fixture::query()->where(['day_timestamp'=>$timestamp,'league_id'=>$league_id])
            ->orderByDesc('id')->get();
        return $data;
    }
    static function getFixtureEventByLeague($league_id,$date_)
    {
        $timestamp = Carbon::parse($date_)->getTimestamp();
        $data = FixtureEvent::query()->leftJoin('fixtures','fixtures.id','=','fixture_events.lt_fixture_id')
            ->where(['fixture_events.day_timestamp' => $timestamp,'team_position'=>"AWAY",'fixtures.league_id'=>$league_id])
            ->orderByDesc('fixture_events.id')->get();
        return $data;
    }
    static function getLeague($league_id)
    {
        return League::query()->firstWhere(['league_id'=>$league_id]);
    }
    static function getPlayingItem($game_id,$fixture_item_id)
    {
        $play=PlayingFixture::query()->firstWhere(['game_play_id'=>$game_id,'loto_fixture_item_id'=>$fixture_item_id]);
        return $play;
    }
    static function calculPointHome($stading)
    {
        return $stading->home_win * 3 + $stading->home_draw;
    }
    static function calculAmountWinner($cagnote,$players,$totalfixture){
        $amount_winners=[];
        $amount_x_x=$cagnote*0.5;
        $amount_x_1=$cagnote*0.2;
        $amount_x_2=$cagnote*0.1;
        $winner_x_x= array_filter($players,function ($iten) use ($totalfixture) {
            $res=false;
            $value= $totalfixture- $iten["count"];
            if ($value==0){
                $res= true;
            }
            return $res;
        });
        $winner_1_x= array_filter($players,function ($iten) use ($totalfixture) {
            $res=false;
            $value= $totalfixture- $iten["count"];
            if ($value==1){
                $res= true;
            }
            return $res;
        });
        $winner_x_2= array_filter($players,function ($iten) use ($totalfixture) {
            $res=false;
            $value= $totalfixture- $iten["count"];
            if ($value==2){
                $res= true;
            }
            return $res;
        });
        foreach ($winner_x_x as $wi){
            $amount_winners[]=[
                "game_id" => $wi["game_id"],
                "user" => $wi["user"],
                "address" => $wi["address"],
                "count" => $wi["count"],
                "amount"=>$amount_x_x/sizeof($winner_x_x)
            ];
        }
        foreach ($winner_1_x as $wi){
            $amount_winners[]=[
                "game_id" => $wi["game_id"],
                "user" => $wi["user"],
                "address" => $wi["address"],
                "count" => $wi["count"],
                "amount"=>$amount_x_1/sizeof($winner_1_x)
            ];
        }
        foreach ($winner_x_2 as $wi){
            $amount_winners[]=[
                "game_id" => $wi["game_id"],
                "user" => $wi["user"],
                "address" => $wi["address"],
                "count" => $wi["count"],
                "amount"=>$amount_x_2/sizeof($winner_x_2)
            ];
        }

        return $amount_winners;
    }
  static function calculSoldeGrille($lotto_fixture_id){
        $games=GamePlay::query()->where(['lotto_fixture_id'=>$lotto_fixture_id])->count();
        return $games*env("PRICE_GAME");

   }
}
