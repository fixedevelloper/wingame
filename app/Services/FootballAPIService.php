<?php


namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class FootballAPIService
{

    /**
     * @throws GuzzleException
     */
    static function getLeagues(){
        $options=[
        ];
        $client = new Client(['headers' => $options]);
        $res = $client->request('GET', env("APIFOOT_KEY_URL").'/list_leagues');
        return json_decode($res->getBody());
    }

    /**
     * @param $league
     * @param $season
     * @return mixed
     * @throws GuzzleException
     */
    static function getTeams($league,$season){
        $options=[
            'x-rapidapi-host' => 'api-football-v1.p.rapidapi.com',
            'x-rapidapi-key' => env("APIFOOT_KEY")
        ];
        $client = new Client(['headers' => $options]);
        $res = $client->request('GET', env("APIFOOT_KEY_URL").'/teams',
            ['query' => [ 'league' => $league,'season'=>$season]]);
        return json_decode($res->getBody());
    }
    /**
     * @throws GuzzleException
     */
    static function getCountries(){
        $options=[
            'x-rapidapi-host' => 'api-football-v1.p.rapidapi.com',
            'x-rapidapi-key' => env("APIFOOT_KEY")
        ];
        $client = new Client(['headers' => $options]);
        $res = $client->request('GET', env("APIFOOT_KEY_URL").'/countries');
        return json_decode($res->getBody());
    }

    /**
     * @param $from
     * @param $to
     * @return mixed
     * @throws GuzzleException
     */
    static function getAllFixturesBetweenDate($from,$to){
        $options=[
        ];
        $client = new Client(['headers' => $options]);
        $res = $client->request('GET', env("APIFOOT_KEY_URL").'/list_fixture',
            ['query' => ["date"=> $from,'date_end' => $to]]);
        return json_decode($res->getBody(),true);
    }
    static function getAllFixturesBetweenDateWithLeague($league,$from,$to){
        $options=[
            'x-rapidapi-host' => 'api-football-v1.p.rapidapi.com',
            'x-rapidapi-key' => env("APIFOOT_KEY")
        ];
        $client = new Client(['headers' => $options]);
        $res = $client->request('GET', env("APIFOOT_KEY_URL").'/fixtures',
            ['query' => [ "league"=> $league,'season' => '2023', "from"=> $from,'to' => $to]]);
        return json_decode($res->getBody());
    }

}
