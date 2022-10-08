<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit('Something Went Wrong!');
}
require_once('../../db/database.php');
$config = getConfig();
$conn = Database::getInstance($config->api_key);

$Token = $_GET['token'];
$NewPass = $_GET['pass'];
$md5_pass = md5($NewPass);

$resultat = $conn->query("SELECT * FROM mail_token_details WHERE token = '$Token'");
$resultat->setFetchMode(PDO::FETCH_OBJ);
$json =array();
if( $Data = $resultat->fetch()) {
    $Tkn_Time =  base64_decode($Token);
    $d=strtotime("now");
    $Current_DT =  date("Y-m-d h:i:s", $d);
    $to_time = strtotime($Current_DT);
    $from_time = strtotime($Tkn_Time);
    $Diff = ($to_time - $from_time) / 60;
    if($Diff>5) {
        echo "Expired";
    } else {
        $sql = "UPDATE user_db SET password=? WHERE email=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$md5_pass, $Data->mail]);
        echo "Password Updated successfully";
    }
} else {
    echo "Invalid Request";
}



function getConfig() {
    require_once('../../db/config.php');
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $resultat = $bdd->query("SELECT * FROM config WHERE id = 1");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $json =array();
    while( $Data = $resultat->fetch() ) 
    {
        return $Data;
    }
}