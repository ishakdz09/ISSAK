<?php
require_once('../db/database.php');
$bdd = Database::getInstance($_SERVER['HTTP_X_API_KEY']);

date_default_timezone_set("Asia/Kolkata");
$Today = date("Y-m-d");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $bdd != null) {
    $data = json_decode(file_get_contents("php://input"));
    
    $User_ID = $_POST["User_ID"];
    $name = $_POST["name"];
    $subscription_type = $_POST["subscription_type"];
    $time = $_POST["time"];
    $amount = $_POST["amount"];

    echo $data;

    $exp_Date = date('Y-m-d', strtotime($Today . " + " . $time . " day"));

    $sql ="UPDATE user_db SET active_subscription =? , subscription_type =?, time =?, amount =?, subscription_start =?, subscription_exp =? WHERE id =?";
    $stmt= $bdd->prepare($sql);
    $stmt->execute([$name, $subscription_type, $time, $amount, $Today, $exp_Date, $User_ID]);
    
    echo "Account Upgraded Succefully";
}