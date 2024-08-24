<?php


namespace App\Http\Controllers;


use App\Helpers\ConvertHelper;
use App\Models\Scrappronos;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Http\Request;

class ScrapperController extends Controller
{
    public function scrapper_list(Request $request)
    {
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->getTimestamp();
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->getTimestamp();
        }
        $lines=Scrappronos::query()->where(['date'=>$date_])->get();
        return view('scraping.scrapping_list', [
            'lines'=>$lines
        ]);
    }
    public function scrapper_page(Request $request)
    {

        $client = new Client();
        $lines=[];
        if (is_null($request->get('date'))) {
            $date_ = Carbon::today()->format('Y-m-d');
            $timestamp = Carbon::today()->getTimestamp();
        } else {
            $date_ = $request->get('date');
            $timestamp = Carbon::parse($date_)->getTimestamp();
        }
        if ($request->method()=='POST'){
            // Go to the symfony.com website
            $crawler = $client->request('GET', $request->search);
            $tables= $crawler->filter('.tablesaw')->each(function ($node) {
                $head = $node->filter("thead");
                $body = $node->filter("tbody")->html();
                return  $data = ConvertHelper::getdata($this->strip_comments($node->html()));

            });
            for ($i=1;$i<sizeof($tables[1]);$i++){

                $lines[]=[
                    'home'=>$this->diviseString($tables[1][$i][3]),
                    'away'=>$this->diviseString($tables[1][$i][7]),
                    'logique'=>$tables[1][$i][8],
                    'surprises'=>$tables[1][$i][9],
                    'domicile'=>$tables[1][$i][10],
                    'nul'=>$tables[1][$i][11],
                    'exterieur'=>$tables[1][$i][12],
                ];
            }
        }

        return view('scraping.scrapping', [
            'lines'=>$lines
        ]);
    }
    public function scrapper_save(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $ob = $data['ob'];

        for ($i = 0; $i < sizeof($ob); ++$i) {
            logger((explode("-",$ob[$i]['home'])));
            if (isset(explode("-",$ob[$i]['home'])[1])){
                $pronos = Scrappronos::query()->firstWhere(['date' => $ob[$i]['date'],
                    'team_home'=>explode("-",$ob[$i]['home'])[0],'team_away'=>explode("-",$ob[$i]['home'])[1]]);
                if (is_null($pronos)) {
                    $pronos = new Scrappronos();
                    $pronos->date = $ob[$i]['date'];
                }
                $pronos->team_home =explode("-",$ob[$i]['home'])[0];
                $pronos->team_away = explode("-",$ob[$i]['home'])[1];
                $pronos->logique = $ob[$i]['logique'];
                $pronos->suprise = $ob[$i]['suprise'];
                $pronos->domicile =$ob[$i]['domicile'];
                $pronos->null =$ob[$i]['nul'];
                $pronos->exterieur =$ob[$i]['exterieur'];
                $pronos->score_h =$ob[$i]['score_h'];
                $pronos->score_a =$ob[$i]['score_a'];
                $data=[
                    $ob[$i]['logique'],
                    $ob[$i]['suprise'],
                    $ob[$i]['domicile'],
                    $ob[$i]['nul'],
                    $ob[$i]['exterieur']
                ];
                $result=$this->calculStat1($data);
                logger($result);
                $pronos->stat_1 =($result['n1']/sizeof($data))*100;
                $pronos->stat_2 =($result['n2']/sizeof($data))*100;
                $pronos->stat_n =($result['n3']/sizeof($data))*100;
                $pronos->stat_12 =($result['n12']/sizeof($data))*100;
                $pronos->save();
            }

        }
        return response()->json($ob);
    }
    function calculStat1($data){
        $n1=0;
        $n2=0;
        $n3=0;
        $n12=0;
        for ($i=0;$i<sizeof($data);$i++){
            switch ($data[$i]){
                case 1:
                    $n1+=1;
                    break;
                case 2:
                    $n2+=1;
                    break;
                case "N":
                    $n3+=1;
                    break;
                case 12:
                    $n12+=1;
                    break;

            }

        }
        return [
            'n1'=>$n1,
            'n2'=>$n2,
            'n3'=>$n3,
            'n12'=>$n12,

        ];

    }
    function strip_comments($html)
    {
        $html = str_replace(array("\r\n<!--", "\n<!--"), "<!--", $html);
        while (($pos = strpos($html, "<!--")) !== false) {
            if (($_pos = strpos($html, "-->", $pos)) === false)
                $html = substr($html, 0, $pos);
            else
                $html = substr($html, 0, $pos) . substr($html, $_pos + 3);
        }
        return $html;
    }
    function diviseString($str){
        $tail=str_split($str);
        return substr($str,sizeof($tail)/2);
    }
}
