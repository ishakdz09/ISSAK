<?php
require '../../db/config.php';
require_once('../../db/database.php');
require_once('../../db/dumper.php');
$conn = Database::getInstance($_SERVER['HTTP_X_API_KEY']);

date_default_timezone_set("Asia/Kolkata");
$Today = date("Y-m-d_h-i-s");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $conn != null && isset($_GET['type']) && isset($_GET['name'])) {
    $type = $_GET['type'];
    $name = $_GET['name'];
    if($type == "exportDatabase") {
        if(exportDatabase($servername, $username, $password, $dbname, $name, $Today)) {
            echo "export Successfull";
        } else {
            echo "Something Went Wrong";
        }
    } else if($type == "importDatabase") {

    } else {
        header("HTTP/1.1 401 Unauthorized");
    }

} else {
    header("HTTP/1.1 401 Unauthorized");
}

function exportDatabase($host, $user, $password, $database, $targetFilePath, $Today)
{
    $world_dumper = Shuttle_Dumper::create(array(
        'host' => $host,
        'username' => $user,
        'password' => $password,
        'db_name' => $database,
    ));
    $world_dumper->dump("../../db/backup/".$targetFilePath."_".$Today.".sql");
    return true;
}