<?php
require_once('../db/database.php');
$bdd = Database::getInstance($_SERVER['HTTP_X_API_KEY']);

$json =array();

if($bdd != null) {

    $main_content_id = $_GET['main_content_id'];
    $content_url = $_GET['content_url'];
    $ct = $_GET['ct'];

    if($ct == 1) {
        $resultat = $bdd->query("SELECT id FROM movie_play_links WHERE movie_id = '$main_content_id' AND status = '1' AND url = '$content_url'");
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        while( $Data = $resultat->fetch() ) 
        {
           $json = $Data;
        }
    } else if($ct == 2) {
        $resultat = $bdd->query("SELECT id FROM web_series_episoade WHERE content_id = '$content_id' AND status = '1' AND content_type = '$ct'");
        $resultat->setFetchMode(PDO::FETCH_OBJ);
        while( $Data = $resultat->fetch() ) 
        {
           $json = $Data;
        }
    }

      
    
    if(json_encode($json) != "") {
        echo json_encode($json, JSON_UNESCAPED_SLASHES);
    } else {
        echo "No Data Avaliable";
    }

}
    
?>