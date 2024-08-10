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
        //$from = "2024-06-30";
       // $from = date('Y-m-d');

        $date_ = Carbon::today()->format('Y-m-d');
        $tomorow_ = Carbon::today()->addDays(1)->format('Y-m-d');

        $arrays = [$date_, $tomorow_];
        for ($p = 0; $p < sizeof($arrays); $p++) {
            $timestamp = Carbon::parse($arrays[$p])->getTimestamp();
            $fixtures = Fixture::query()->where(['day_timestamp' => $timestamp])
                ->orderByDesc('id')->get();
            foreach ($fixtures as $fixture) {
                $lasts = Fixture::query()->where(['team_away_id' => $fixture->team_away_id])
                    ->where('day_timestamp', '<', $fixture->day_timestamp)->orderByDesc('date')->limit(5)->get();;
                $count = 0;
                foreach ($lasts as $last) {
                    if ($last->score_ft_home - $last->score_ft_away > 0) {
                        $count += 1;
                    }
                }
                if ($count > 3) {
                    $event = FixtureEvent::query()->firstWhere(['lt_fixture_id' => $fixture->id, 'team_position' => "AWAY", 'day_timestamp' => $fixture->day_timestamp]);
                    if (is_null($event)) {
                        $event = new FixtureEvent();
                    }

                    $event->lt_fixture_id = $fixture->id;
                    $event->fixture_id = $fixture->fixture_id;
                    $event->team_position = "AWAY";
                    $event->day_timestamp = $fixture->day_timestamp;
                    $event->save();
                }

                $last_homes = Fixture::query()->where(['team_home_id' => $fixture->team_home_id])
                    ->where('day_timestamp', '<', $fixture->day_timestamp)->orderByDesc('date')->limit(5)->get();
                $count_home = 0;
                foreach ($last_homes as $lasth) {
                    if ($lasth->score_ft_home - $lasth->score_ft_away < 0) {
                        $count_home += 1;
                    }

                }
                if ($count_home > 3) {
                    logger($count_home);
                    $eventH = FixtureEvent::query()->firstWhere(['lt_fixture_id' => $fixture->id, 'team_position' => "HOME", 'day_timestamp' => $fixture->day_timestamp]);
                    if (is_null($eventH)) {
                        $eventH = new FixtureEvent();
                    }
                    $eventH->lt_fixture_id = $fixture->id;
                    $eventH->fixture_id = $fixture->fixture_id;
                    $eventH->team_position = "HOME";
                    $eventH->day_timestamp = $fixture->day_timestamp;
                    $eventH->save();
                }
            }
        }
    }
}
