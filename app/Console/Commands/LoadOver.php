<?php

namespace App\Console\Commands;

use App\Models\ExactScoreFixture;
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
        $p_data = FootballAPIService::getAllFixturesBetweenDateAndBookmekerPage($date_);
        $paging = $p_data->paging->total;
        $this->createOver($paging, $date_);
        $this->createNormal($paging, $date_);
        $this->createExacteScore($paging, $date_);
    }

    function createOver($paging, $date_)
    {
        for ($j = 1; $j <= $paging; $j++) {
            $data = FootballAPIService::getAllFixturesBetweenDateAndBookmeker($date_, $j);
            $response = $data->response;
            for ($k = 0; $k < sizeof($response); $k++) {
                $overFixture = OverFixture::query()->firstWhere(['fixture_id' => $response[$k]->fixture->id]);
                if (is_null($overFixture)) {
                    $bookmakers = $response[$k]->bookmakers[0]->bets[0]->values;
                    for ($i = 0; $i < sizeof($bookmakers); $i++) {
                        if ($bookmakers[$i]->value == "Over 5.5") {
                            $over = new OverFixture();
                            $over->fixture_id = $response[$k]->fixture->id;
                            $over->over_type = "OVER_55";
                            $over->date = $date_;
                            $over->value = $bookmakers[$i]->odd;
                            $over->save();
                        }
                        if ($bookmakers[$i]->value == "Over 6.5") {
                            $over = new OverFixture();
                            $over->fixture_id = $response[$k]->fixture->id;
                            $over->over_type = "OVER_65";
                            $over->date = $date_;
                            $over->value = $bookmakers[$i]->odd;
                            $over->save();
                        }
                        if ($bookmakers[$i]->value == "Over 7.5") {
                            $over = new OverFixture();
                            $over->fixture_id = $response[$k]->fixture->id;
                            $over->over_type = "OVER_75";
                            $over->date = $date_;
                            $over->value = $bookmakers[$i]->odd;
                            $over->save();
                        }
                        if ($bookmakers[$i]->value == "Over 8.5") {
                            $over = new OverFixture();
                            $over->fixture_id = $response[$k]->fixture->id;
                            $over->over_type = "OVER_85";
                            $over->date = $date_;
                            $over->value = $bookmakers[$i]->odd;
                            $over->save();
                        }

                    }
                }

            }
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
                    $over = new OverFixture();
                    $over->fixture_id = $response[$k]->fixture->id;
                    $over->date = $date_;
                }
                    $bookmakers = $response[$k]->bookmakers[0]->bets[0]->values;
                    $over->home = $bookmakers[0]->odd;
                    $over->away = $bookmakers[2]->odd;
                    $over->draw = $bookmakers[1]->odd;
                    $over->save();


            }
        }
    }

    function createExacteScoreInit($page, $date_)
    {
        for ($j = 1; $j <= $page; $j++) {
            $data = FootballAPIService::getAllFixturesDateAndBookmekerBet10($date_, $j);
            $response = $data->response;
            for ($k = 0; $k < sizeof($response); $k++) {
                $overFixture = ExactScoreFixture::query()->firstWhere(['fixture_id' => $response[$k]->fixture->id]);
                if (is_null($overFixture)) {
                    $bookmakers = $response[$k]->bookmakers[0]->bets[0]->values;
                    for ($i = 0; $i < sizeof($bookmakers); $i++) {
                        logger("******************************************");
                        if ($bookmakers[$i]->value == "1:0" && $bookmakers[$i]->odd <= 10) {
                            $odd_1_0 = $bookmakers[$i]->odd;
                            logger($bookmakers[$i]->odd);
                            if ($bookmakers[$i]->value == "1:1" && $bookmakers[$i]->odd <= 10) {
                                $odd_1_1 = $bookmakers[$i]->odd;
                                logger($bookmakers[$i]->odd);
                                if ($bookmakers[$i]->value == "0:0" && $bookmakers[$i]->odd <= 10) {
                                    $odd_0_0 = $bookmakers[$i]->odd;
                                    logger($bookmakers[$i]->odd);
                                    if ($bookmakers[$i]->value == "0:1" && $bookmakers[$i]->odd <= 10) {
                                        $odd_0_1 = $bookmakers[$i]->odd;
                                        logger($bookmakers[$i]->odd);
                                        $over = new ExactScoreFixture();
                                        $over->fixture_id = $response[$k]->fixture->id;
                                        $over->value_0_0 = $odd_0_0;
                                        $over->value_0_1 = $odd_0_1;
                                        $over->value_1_0 = $odd_1_0;
                                        $over->value_1_1 = $odd_1_1;
                                        $over->date = $date_;
                                        // $over->save();
                                    }
                                }
                            }

                        }

                    }
                }

            }
        }
    }

    function createExacteScore($page, $date_)
    {
        for ($j = 1; $j <= $page; $j++) {
            $data = FootballAPIService::getAllFixturesDateAndBookmekerBet10($date_, $j);
            $response = $data->response;
            for ($k = 0; $k < sizeof($response); $k++) {
                $overFixture = ExactScoreFixture::query()->firstWhere(['fixture_id' => $response[$k]->fixture->id]);
                if (is_null($overFixture)) {
                    $bookmakers = $response[$k]->bookmakers[0]->bets[0]->values;
                    $count = 0;
                    $odd_1_0 = null;
                    $odd_1_1 = null;
                    $odd_0_0 = null;
                    $odd_0_1 = null;
                    for ($i = 0; $i < sizeof($bookmakers); $i++) {
                        if ($bookmakers[$i]->value == "1:0" && $bookmakers[$i]->odd <= 10) {
                            $odd_1_0 = $bookmakers[$i]->odd;
                            logger($bookmakers[$i]->odd);
                            $count++;
                        }
                        if ($bookmakers[$i]->value == "1:1" && $bookmakers[$i]->odd <= 10) {
                            $odd_1_1 = $bookmakers[$i]->odd;
                            logger($bookmakers[$i]->odd);
                            $count++;
                        }
                        if ($bookmakers[$i]->value == "0:0" && $bookmakers[$i]->odd <= 10) {
                            $odd_0_0 = $bookmakers[$i]->odd;
                            logger($bookmakers[$i]->odd);
                            $count++;
                        }
                        if ($bookmakers[$i]->value == "0:1" && $bookmakers[$i]->odd <= 10) {
                            $odd_0_1 = $bookmakers[$i]->odd;
                            logger($bookmakers[$i]->odd);
                            $count++;
                        }
                    }
                    if ($count > 3) {
                        $over = new ExactScoreFixture();
                        $over->fixture_id = $response[$k]->fixture->id;
                        $over->value_0_0 = $odd_0_0;
                        $over->value_0_1 = $odd_0_1;
                        $over->value_1_0 = $odd_1_0;
                        $over->value_1_1 = $odd_1_1;
                        $over->date = $date_;
                        $over->save();
                    }

                }

            }
        }
    }
}
