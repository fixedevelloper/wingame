<?php


namespace App\Http\Controllers;


use App\Helpers\ConvertHelper;
use Goutte\Client;
use Illuminate\Http\Request;

class ScrapperController extends Controller
{
    public function scrapper_page(Request $request)
    {

        $client = new Client();
        $lines=[];
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
