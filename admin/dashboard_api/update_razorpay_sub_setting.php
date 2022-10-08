<?php
require_once('../../db/database.php');
$conn = Database::getInstance($_SERVER['HTTP_X_API_KEY']);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $conn != null) {
    $Body_Json =  file_get_contents('php://input');
    $Json_data = $obj = json_decode($Body_Json);

    function SQLSafe(string $s): string {
        $NewData = stripslashes($s);
        return addslashes($NewData);
    }

    $razorpay_status_int = $Json_data->razorpay_status_int;
    $razorpay_key_id = $Json_data->razorpay_key_id;
    $razorpay_key_secret = $Json_data->razorpay_key_secret;

    $sql ="UPDATE config SET razorpay_status =? , razorpay_key_id =?, razorpay_key_secret =? WHERE id =?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$razorpay_status_int, $razorpay_key_id, $razorpay_key_secret, '1']);

    echo "razorpay Sub Settings Updated successfully";
} else  {
    header("HTTP/1.1 401 Unauthorized");
}



            ?>