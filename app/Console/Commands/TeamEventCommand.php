<?php

namespace App\Console\Commands;

use App\Helpers\Helpers;
use App\Models\Fixture;
use App\Models\Team;
use App\Models\TeamEvent;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TeamEventCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:team-event-command';

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
        $this->last5_no_lost();
    }
    private function last5_no_lost(){
        $date_ = Carbon::today()->format('Y-m-d');
        $timestamp = Carbon::today()->getTimestamp();
        $fixtures=Fixture::query()->where(['day_timestamp' => $timestamp])->get();
        foreach ($fixtures as $fixture){
            if (Helpers::getTeamNoLostLast5($fixture->team_home_id,$timestamp)==true){
                $teamE=TeamEvent::query()->firstWhere(['team_id'=>$fixture->team_home_id,'day_timestamp'=>$timestamp]);
                if (is_null($teamE)){
                    $teamE=new TeamEvent();
                }
                $teamE->team_id=$fixture->team_home_id;
                $teamE->fixture_id=$fixture->id;
                $teamE->day_timestamp=$timestamp;
                $teamE->last5_no_lost=true;
                $teamE->save();
            }
            if (Helpers::getTeamNoLostLast5($fixture->team_away_id,$timestamp)==true){
                $teamE=TeamEvent::query()->firstWhere(['team_id'=>$fixture->team_away_id,'day_timestamp'=>$timestamp]);
                if (is_null($teamE)) {
                    $teamE = new TeamEvent();
                }
                $teamE->team_id=$fixture->team_away_id;
                $teamE->fixture_id=$fixture->id;
                $teamE->day_timestamp=$timestamp;
                $teamE->last5_no_lost=true;
                $teamE->save();
            }
        }
    }
}
