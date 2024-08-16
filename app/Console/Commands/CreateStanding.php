<?php

namespace App\Console\Commands;

use App\Models\League;
use App\Models\Standing;
use App\Services\FootballAPIService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateStanding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-standing';

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
        $this->standing();
    }

    function standing()
    {
        $timestamp = Carbon::today()->getTimestamp();
       // $leagues = League::all();
        $season = env("season","2024");
        $leagues = \App\Models\LeagueDay::query()->leftJoin('leagues', 'leagues.league_id', "=", 'league_days.league_id')
            ->where(['timestamp' => $timestamp])
            ->orderBy('leagues.league_id', 'asc')
            ->distinct()->get();

        try {
            foreach ($leagues as $league) {
                $res = FootballAPIService::getStatdings($league->league_id, $season);
                if (sizeof($res->response) > 0) {
                    $data = $res->response[0]->league->standings[0];
                    for ($i = 0; $i < sizeof($data); $i++) {
                        $stading = Standing::query()->firstWhere(['league_id' => $league->league_id, 'team_id' => $data[$i]->team->id, 'season' => $season]);
                        if (is_null($stading)) {
                            $stading = new Standing();
                            $stading->league_id = $league->league_id;
                            $stading->team_id = $data[$i]->team->id;
                            $stading->season = $season;
                            $stading->group = $data[$i]->group;
                        }
                        $stading->rank = $data[$i]->rank;
                        $stading->points = $data[$i]->points;
                        $stading->goal_diff = $data[$i]->goalsDiff;
                        $stading->status = $data[$i]->status;
                        $stading->home_played = $data[$i]->home->played;
                        $stading->home_win = $data[$i]->home->win;
                        $stading->home_lost = $data[$i]->home->lose;
                        $stading->home_draw = $data[$i]->home->draw;
                        $stading->home_goal_for = $data[$i]->home->goals->for;
                        $stading->home_goal_against = $data[$i]->home->goals->against;
                        //$stading->update_round=date('Y-m-d',date_timestamp_get($data[$i]->update));
                        $stading->away_played = $data[$i]->away->played;
                        $stading->away_win = $data[$i]->away->win;
                        $stading->away_lost = $data[$i]->away->lose;
                        $stading->away_draw = $data[$i]->away->draw;
                        $stading->away_goal_for = $data[$i]->away->goals->for;
                        $stading->away_goal_against = $data[$i]->away->goals->against;
                        $stading->form = $data[$i]->form;
                        $stading->point_home = $data[$i]->home->win * 3 + $data[$i]->home->draw;
                        $stading->point_away = $data[$i]->away->win * 3 + $data[$i]->away->draw;
                        $stading->goal_diff_home = $data[$i]->home->goals->for - $data[$i]->home->goals->against;
                        $stading->goal_diff_away = $data[$i]->away->goals->for - $data[$i]->away->goals->against;

                        $stading->goal_home_against = $data[$i]->home->goals->against;
                        $stading->goal_home_for = $data[$i]->home->goals->for;
                        $stading->goal_away_against = $data[$i]->away->goals->against;
                        $stading->goal_away_for = $data[$i]->away->goals->for;
                        $stading->save();
                    }
                }

            }
        } catch (\Exception $exception) {
            logger($exception);
        }


    }
}
