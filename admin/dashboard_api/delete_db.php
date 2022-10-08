<?php
require_once('../../db/database.php');
$conn = Database::getInstance($_SERVER['HTTP_X_API_KEY']);

$file = $_GET['file'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $conn != null && isset($file)) {

    unlink("../../db/backup/".$file);
    echo "Delete Successfull";

} else  {
    header("HTTP/1.1 401 Unauthorized");
}


?>