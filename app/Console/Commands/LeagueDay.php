<?php

namespace App\Console\Commands;

use App\Models\Fixture;
use App\Services\FootballAPIService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LeagueDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:league-day';

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
        $from = date('Y-m-d');
       $temes= Carbon::parse(Carbon::parse($from)->format('y-m-d'))->getTimestamp();
        $data = FootballAPIService::getAllFixturesBetweenDate($from);
        $response = $data->response;
        for ($i = 0; $i < sizeof($response); $i++) {
            $league = \App\Models\LeagueDay::query()->firstWhere(['league_id' => $response[$i]->league->id,'day_timestamp'=>$temes]);
            if (is_null($league)) {
                $league = new \App\Models\LeagueDay();
                $league->league_id = $response[$i]->league->id;
                $league->league_season = $response[$i]->league->season;
                $league->day_timestamp = Carbon::parse(Carbon::parse($response[$i]->fixture->date)->format('y-m-d'))->getTimestamp();

            }
            $league->save();
        }
    }
}
