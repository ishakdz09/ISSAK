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

    $hlsManifestUrl = get_string_between($html, "hlsManifestUrl", "},");

    $mathResult = substr(trim($hlsManifestUrl), 3, -1);

    header("Location: $mathResult");
    die();


    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
     }