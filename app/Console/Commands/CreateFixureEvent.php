<?php

namespace App\Console\Commands;

use App\Models\Fixture;
use App\Models\FixtureEvent;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateFixureEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-fixure-event';

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
        $from = "2024-06-30";
        //$from = date('Y-m-d');
        $timestamp = Carbon::parse($from)->getTimestamp();
        $fixtures=Fixture::query()->where(['day_timestamp' => $timestamp])
            ->orderByDesc('id')->get();
        foreach ($fixtures as $fixture){
            $lasts=Fixture::query()->where(['team_away_id'=>$fixture->team_away_id])->orWhere(['team_home_id'=>$fixture->team_away_id])->limit(5)->get();
            $count=0;
            foreach ($lasts as $last){
                if ($last->team_home_id==$fixture->team_away_id && $last->goal_home<$last->goal_away){
                    $count+=1;
                }
                if ($last->team_away_id==$fixture->team_away_id && $last->goal_home>$last->goal_away){
                    $count+=1;
                }
            }
            if ($count>3){
               $event=new FixtureEvent();
               $event->lt_fixture_id=$fixture->id;
               $event->fixture_id=$fixture->fixture_id;
               $event->team_position="AWAY";
               $event->day_timestamp=$fixture->day_timestamp;
               $event->save();
            }

            $last_homes=Fixture::query()->where(['team_away_id'=>$fixture->team_home_id])->orWhere(['team_home_id'=>$fixture->team_home_id])->limit(5)->get();
            $count_home=0;
            foreach ($last_homes as $last){
                if ($last->team_home_id==$fixture->team_away_id && $last->goal_home<$last->goal_away){
                    $count_home+=1;
                }
                if ($last->team_away_id==$fixture->team_away_id && $last->goal_home>$last->goal_away){
                    $count_home+=1;
                }
            }
            if ($count_home>3){
                $eventH=new FixtureEvent();
                $eventH->lt_fixture_id=$fixture->id;
                $eventH->fixture_id=$fixture->fixture_id;
                $eventH->team_position="HOME";
                $eventH->day_timestamp=$fixture->day_timestamp;
                $eventH->save();
            }
        }
    }
}
