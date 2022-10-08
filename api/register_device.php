<?php
require_once('../db/database.php');
date_default_timezone_set("Asia/Kolkata");
$date = date('m-d-Y', time());
$time = date('h:i:s a', time());

$conn = Database::getInstance($_SERVER['HTTP_X_API_KEY']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $conn != null) {

    function SQLSafe(string $s): string {
        return addslashes($s);
    }

    $device = SQLSafe($_POST["device"]);


    $select = $conn->prepare("SELECT * FROM devices WHERE device = ?");
    $select->execute([$device]);
    if ($select->rowCount() > 0) {
        $select->setFetchMode(PDO::FETCH_OBJ);
        $Data = $select->fetch();
        $device_id = $Data->id;
    } else {
        $sql = "INSERT INTO devices (device)
        VALUES ('$device')";
        $conn->exec($sql);
        $device_id = $conn->lastInsertId();
    }

    $sql = "INSERT INTO devices_log (device_id, open_date, open_time)
        VALUES ('$device_id', '$date', '$time')";
    $conn->exec($sql);

} else  {
    header("HTTP/1.1 401 Unauthorized");
}



            ?>