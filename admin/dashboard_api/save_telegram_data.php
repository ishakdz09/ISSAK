<?php
require_once('../../db/database.php');
$conn = Database::getInstance($_SERVER['HTTP_X_API_KEY']);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $conn != null) {
    $Body_Json =  file_get_contents('php://input');
    $Json_data = $obj = json_decode($Body_Json);

            $telegram_bot_token = $Json_data->telegram_bot_token;
            $teligram_chat_id =$Json_data->teligram_chat_id;

            $sql ="UPDATE config SET telegram_token =?, telegram_chat_id =? WHERE id = 1";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$telegram_bot_token, $teligram_chat_id]);

            echo "Telegram Data Updated successfully";
            
    
} else  {
    header("HTTP/1.1 401 Unauthorized");
}



            ?>