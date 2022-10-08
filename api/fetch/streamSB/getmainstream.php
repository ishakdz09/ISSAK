<?php
header("Access-Control-Allow-Origin: *");
header("Connection: keep-alive");
header("Content-Type: application/x-mpegURL");
header("Transfer-Encoding: chunked");
header("X-Cache-Status: HIT");


$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);

if(isset($_GET["urlpart"])) {
    $actual_link0 = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $contents = file_get_contents("https://delivery251.akamai-cdn-content.com".explode("urlpart=",$actual_link0)[1], false, stream_context_create($arrContextOptions));

    $mainparts = str_replace("?urlpart=","?seg=", $actual_link0);
    $mainURLPart = substr($mainparts, 0,strrpos($mainparts, '/'));
    echo preg_replace("/https:\/\/[a-z]{8}[0-9]{3}\.akamai-cdn-content\.com\/[a-z]{3}[0-9]{1}\/[0-9]{2}\/[0-9]{5}\/[a-z0-9_]{14}\//i", "", str_replace("seg-", $mainURLPart."/seg-", $contents));
}if(isset($_GET["seg"])) { 
    $actual_link1 = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $contents = file_get_contents("https://delivery251.akamai-cdn-content.com".explode("seg=",$actual_link1)[1], false, stream_context_create($arrContextOptions));
    echo $contents;
} else {
    $streamsbURL = base64_decode($_GET['url']);
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $streamsbURL,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "watchsb: streamsb"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $mailUrl = json_decode($response)->stream_data->file;
      $mainContents = file_get_contents($mailUrl, false, stream_context_create($arrContextOptions));

       $finalContents = explode("#EXT-X-I-FRAME-STREAM",$mainContents)[0];

      //$finalContents = "#EXTM3U #EXT-X-I-FRAME-STREAM".explode("#EXT-X-I-FRAME-STREAM",$mainContents)[1]."#EXT-X-I-FRAME-STREAM".explode("#EXT-X-I-FRAME-STREAM",$mainContents)[2];
      
      $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      echo preg_replace('/https:\/\/[a-z]{8}[0-9]{3}\.akamai-cdn-content\.com/i',explode("?",$actual_link)[0]."?urlpart=", $finalContents);

      
    }

}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
 }


