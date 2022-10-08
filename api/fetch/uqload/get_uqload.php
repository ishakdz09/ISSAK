<?php
include("./vendor/autoload.php");
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

$url = $_GET['url'];

$guzzleClient = new GuzzleClient(array(
    'timeout' => 60,
));
$client = new Client();
$client->setClient($guzzleClient);
$userAgent = 'Mozilla/5.0 (Windows NT 10.0)'
       . ' AppleWebKit/537.36 (KHTML, like Gecko)'
       . ' Chrome/48.0.2564.97'
       . ' Safari/537.36';

       $headers = array('User-Agent' => $userAgent);
	$crawler = $client->request('GET', $url,$headers);

    $html = $crawler->html();

    $rawUrl =  get_string_between($html, "sources: [", '],');
    
    $CUrl = substr(trim($rawUrl), 1, -1);
    
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $CUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    $headers = array();
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Sec-Ch-Ua: ^^Google';
    $headers[] = 'Dnt: 1';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638    .69 Safari/537.36';
    $headers[] = 'Sec-Ch-Ua-Platform: ^^Windows^^\"\"';
    $headers[] = 'Accept: */*';
    $headers[] = 'Sec-Fetch-Site: cross-site';
    $headers[] = 'Sec-Fetch-Mode: no-cors';
    $headers[] = 'Sec-Fetch-Dest: video';
    $headers[] = 'Referer: https://uqload.com/';
    $headers[] = 'Accept-Language: en-IN,en-US;q=0.9,en;q=0.8,bn;q=0.7,id;q=0.6,pt;q=0.5,hr;q=0.4';
    $headers[] = 'Range: bytes=0-';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo $result;
    }
    curl_close($ch);


    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
     }