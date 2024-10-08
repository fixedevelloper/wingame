<?php

namespace App\Console\Commands;

use App\Models\OverFixture;
use App\Services\FootballAPIService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MakeVariation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-variation';

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
        $date_ = Carbon::today()->format('Y-m-d');
        $tomorow_ = Carbon::today()->addDays(1)->format('Y-m-d');
        $arrays=[$date_,$tomorow_];
        for ($p=0;$p<sizeof($arrays);$p++) {
            $p_data = FootballAPIService::getAllFixturesBetweenDateAndBookmekerPage($arrays[$p]);
            $paging = $p_data->paging->total;
            $this->createNormal($paging, $arrays[$p]);
        }
    }
    function createNormal($paging, $date_)
    {
        for ($j = 1; $j <= $paging; $j++) {
            $data = FootballAPIService::getAllFixturesBetweenDateAndBookmekerAllBetPage($date_, $j);
            $response = $data->response;
            for ($k = 0; $k < sizeof($response); $k++) {
                $overFixture = OverFixture::query()->firstWhere(['fixture_id' => $response[$k]->fixture->id]);
                if (is_null($overFixture)) {
                    $overFixture = new OverFixture();
                    $overFixture->fixture_id = $response[$k]->fixture->id;
                    $overFixture->date = $date_;
                }
                $overFixture->old_home=$overFixture->home;
                $overFixture->old_away=$overFixture->away;
                $overFixture->old_draw=$overFixture->draw;
                $bookmakers = $response[$k]->bookmakers[0]->bets[0]->values;
                $overFixture->home = $bookmakers[0]->odd;
                $overFixture->away =isset($bookmakers[2])?$bookmakers[2]->odd:"" ;
                $overFixture->draw = $bookmakers[1]->odd;
                $overFixture->save();
                if ($overFixture->old_home>0){
                    $overFixture->variation_home =(($overFixture->old_home-$overFixture->home)/$overFixture->old_home)*100;
                }
               if ($overFixture->old_away>0){
                   $overFixture->variation_away =(($overFixture->old_away-$overFixture->away)/$overFixture->old_away)*100;
               }
               if ($overFixture->old_draw>0){
                   $overFixture->variation_draw =(($overFixture->old_draw-$overFixture->draw)/$overFixture->old_draw)*100;
               }
                $overFixture->save();

            }
        }
    }
}
