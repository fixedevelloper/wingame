<?php

namespace App\Console\Commands;

use App\Models\Fixture;
use App\Services\FootballAPIService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LoadFixture extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:load-fixture';

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
        logger("---------step load-------------");

    }
   function loadPropulse(){
       $date_ = Carbon::today()->format('Y-m-d');
       //  $date_ = "2024-01-25";
       $timestamp_ = Carbon::today()->addDays(1)->format('Y-m-d');
       $response=FootballAPIService::getAllFixturesBetweenDate($date_,$timestamp_);
       foreach ($response['data'] as $item){
           $fixture=Fixture::query()->firstWhere(['fixture_id'=>$item['fixture_id']]);
           if (is_null($fixture)){
               $fixture=new Fixture();
               $fixture->fixture_id=$item['fixture_id'];
               $fixture->league_id=$item['league_id'];
               $fixture->league_season=$item['league_season'];
               $fixture->league_round=$item['league_round'];
               $fixture->team_home_id=$item['team_home_id'];
               $fixture->team_away_id=$item['team_away_id'];
               $fixture->timezone=$item['timezone'];
               $fixture->timestamp=$item['timestamp'];
               $fixture->date=$item['date'];
               $fixture->day_timestamp=$item['day_timestamp'];

           }
           $fixture->referee=$item['referee'];
           $fixture->st_long=$item['st_long'];;
           $fixture->st_short=$item['st_short'];;
           $fixture->st_elapsed=$item['st_elapsed'];
           $fixture->team_away_winner=$item['team_away_winner'];;
           $fixture->team_home_winner=$item['team_home_winner'];;
           $fixture->goal_home=$item['goal_home'];;
           $fixture->goal_away=$item['goal_away'];;
           $fixture->score_ht_home=$item['score_ht_home'];;
           $fixture->score_ht_away=$item['score_ht_away'];;
           $fixture->score_ft_home=$item['score_ft_home'];;
           $fixture->score_ft_away=$item['score_ft_away'];;
           $fixture->score_ext_home=$item['score_ext_home'];;
           $fixture->score_ext_away=$item['score_ext_away'];;
           $fixture->score_pt_home=$item['score_pt_home'];;
           $fixture->score_pt_away=$item['score_pt_away'];;
           $fixture->save();
       }
   }
    function createFixtureDate()
    {
        //$leagues = League::query()->where('id', '>', 0)->get();
        $from = date('Y-m-d');
        //  $to=date('Y-m-d', strtotime($from. ' + 1 days'));
        // foreach ($leagues as $league) {
        $data = FootballAPIService::getAllFixturesBetweenDate($from);
        $response = $data->response;
        for ($i = 0; $i < sizeof($response); $i++) {
            $fixture = Fixture::query()->firstWhere(['fixture_id' => $response[$i]->fixture->id]);
            if (is_null($fixture)) {
                $fixture = new Fixture();
                $fixture->league_id = $response[$i]->league->id;
                $fixture->league_season = $response[$i]->league->season;
                $fixture->league_round = $response[$i]->league->round;
                $fixture->team_home_id = $response[$i]->teams->home->id;
                $fixture->team_home_name = $response[$i]->teams->home->name;
                $fixture->team_home_logo = $response[$i]->teams->home->logo;
                $fixture->team_away_id = $response[$i]->teams->away->id;
                $fixture->team_away_logo = $response[$i]->teams->away->logo;
                $fixture->team_away_name = $response[$i]->teams->away->name;
                $fixture->timezone = $response[$i]->fixture->timezone;
                $fixture->timestamp = $response[$i]->fixture->timestamp;
                $fixture->date = $response[$i]->fixture->date;
                $fixture->fixture_id = $response[$i]->fixture->id;
                $fixture->day_timestamp = Carbon::parse(Carbon::parse($response[$i]->fixture->date)->format('y-m-d'))->getTimestamp();

            }
            $fixture->referee = is_null($response[$i]->fixture->referee) ? "" : $response[$i]->fixture->referee;
            $fixture->st_long = $response[$i]->fixture->status->long;
            $fixture->st_short = $response[$i]->fixture->status->short;
            $fixture->st_elapsed = is_null($response[$i]->fixture->status->elapsed) ? " " : $response[$i]->fixture->status->elapsed;
            $fixture->team_away_winner = is_null($response[$i]->teams->away->winner) ? 0 : $response[$i]->teams->away->winner;
            $fixture->team_home_winner = is_null($response[$i]->teams->home->winner) ? 0 : $response[$i]->teams->home->winner;
            $fixture->goal_home = $response[$i]->goals->home;
            $fixture->goal_away = $response[$i]->goals->away;
            $fixture->score_ht_home = $response[$i]->score->halftime->home;
            $fixture->score_ht_away = $response[$i]->score->halftime->away;
            $fixture->score_ft_home = $response[$i]->score->fulltime->home;
            $fixture->score_ft_away = $response[$i]->score->fulltime->away;
            $fixture->score_ext_home = $response[$i]->score->extratime->home;
            $fixture->score_ext_away = $response[$i]->score->extratime->away;
            $fixture->score_pt_home = $response[$i]->score->penalty->home;
            $fixture->score_pt_away = $response[$i]->score->penalty->away;
            $fixture->save();
        }
    }
}
