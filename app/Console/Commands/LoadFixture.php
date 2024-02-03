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
      //  $date_ = Carbon::today()->format('Y-m-d');
        $date_ = "2024-01-25";
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
}
