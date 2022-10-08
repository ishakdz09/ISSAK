<?php
require_once('../../../db/database.php');
$conn = Database::getInstance($_SERVER['HTTP_X_API_KEY']);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $conn != null) {
    $Body_Json =  file_get_contents('php://input');
    $Json_data = $obj = json_decode($Body_Json);


    $sql = "DELETE FROM subscription WHERE id = $Json_data->ID";
    $conn->exec($sql);

    echo "Sub Plan Deleted successfully";
            
    
} else  {
    header("HTTP/1.1 401 Unauthorized");
}


?>