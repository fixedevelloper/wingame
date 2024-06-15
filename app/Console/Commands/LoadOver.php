<?php

namespace App\Console\Commands;

use App\Models\Fixture;
use App\Models\OverFixture;
use App\Services\FootballAPIService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LoadOver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:load-over';

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
        //  $date_ = "2024-01-25";
        $timestamp_ = Carbon::today()->addDays(1)->format('Y-m-d');
        $data=FootballAPIService::getAllFixturesBetweenDateAndBookmeker($date_);
        $response=$data->response;
        for ($k = 0; $k < sizeof($response); $k++) {
            $overFixture=OverFixture::query()->firstWhere(['fixture_id'=>$response[$k]->fixture->id]);
            if (is_null($overFixture)){
                $bookmakers = $response[$k]->bookmakers[0]->bets[0]->values;
                for ($i=0;$i<sizeof($bookmakers);$i++){
                    if ($bookmakers[$i]->value=="Over 5.5"){
                        $over=new OverFixture();
                        $over->fixture_id=$response[$k]->fixture->id;
                        $over->over_type="OVER_55";
                        $over->date=$date_;
                        $over->value=$bookmakers[$i]->odd;
                        $over->save();
                    }
                    if ($bookmakers[$i]->value=="Over 6.5"){
                        $over=new OverFixture();
                        $over->fixture_id=$response[$k]->fixture->id;
                        $over->over_type="OVER_65";
                        $over->date=$date_;
                        $over->value=$bookmakers[$i]->odd;
                        $over->save();
                    }
                    if ($bookmakers[$i]->value=="Over 7.5"){
                        $over=new OverFixture();
                        $over->fixture_id=$response[$k]->fixture->id;
                        $over->over_type="OVER_75";
                        $over->date=$date_;
                        $over->value=$bookmakers[$i]->odd;
                        $over->save();
                    }
                    if ($bookmakers[$i]->value=="Over 8.5"){
                        $over=new OverFixture();
                        $over->fixture_id=$response[$k]->fixture->id;
                        $over->over_type="OVER_85";
                        $over->date=$date_;
                        $over->value=$bookmakers[$i]->odd;
                        $over->save();
                    }

                }
            }

        }
    }
}
