<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit('Something Went Wrong!');
}

require_once('../db/database.php');
$conn = Database::getInstance($_SERVER['HTTP_X_API_KEY']);

$config = getConfig($conn);

$Token = $_GET['token'];
$NewPass = $_GET['pass'];

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
        $stmt->execute([$NewPass, $Data->mail]);
        echo "Password Updated successfully";
    }
} else {
    echo "Invalid Request";
}



function getConfig($conn) {
    $resultat = $conn->query("SELECT * FROM config WHERE id = 1");
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $json =array();
    while( $Data = $resultat->fetch() ) 
    {
        return $Data;
    }
}