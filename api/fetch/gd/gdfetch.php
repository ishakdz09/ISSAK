<?php
require_once('Drive.php');

$url = $_GET['url'];

$s = new Drive();
$res = $s->getResolution();
$s->setID($s->getId($url) ?? "");
$y=str_replace("p","",$res[0]);

$type = $_GET['type'];

if($type=='ld'){
    $x='320p';
} else if($type=='sd'){
    $x='420p';
} else if($type=='hd'){
    $x='720p';
} else if($type=='fhd'){
    $x='1080p';
} else{
    $x='720p';
}

if(in_array($x,$res)){
    $s->setResolution($type ?? "");
}else{
    $s->setResolution($y ?? "");
}

$s->setDownload("1"  ?? "");
$s->stream();