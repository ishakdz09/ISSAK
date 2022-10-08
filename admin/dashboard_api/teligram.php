<?php
function sendMessage($chatID, $messaggio, $token) {
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID . "&disable_web_page_preview=false&parse_mode=HTML";
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return "Message Sended SuccessFully!";
}

require_once('../../db/database.php');
$conn = Database::getInstance($_SERVER['HTTP_X_API_KEY']);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $conn != null) {
    $Body_Json =  file_get_contents('php://input');
$Json_data = $obj = json_decode($Body_Json);

$telegram_token = $Json_data->telegram_token;
$telegram_chat_id = $Json_data->telegram_chat_id;
$Heading = trim($Json_data->Heading);
$Message =trim($Json_data->Message);
$image =$Json_data->image;

if($image != "") {
    $Telegrammessage = <<<TEXT
    <strong> $Heading </strong>
    &#10687;  <code>$Message</code>
    <a href="$image"> ‏ </a>
    TEXT;
} else {
    $Telegrammessage = <<<TEXT
<strong> $Heading </strong>
&#10687;  <code>$Message</code>
TEXT;
}


echo sendMessage($telegram_chat_id, $Telegrammessage, $telegram_token);
}