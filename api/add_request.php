<?php

require_once('../db/database.php');
$conn = Database::getInstance($_SERVER['HTTP_X_API_KEY']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $conn != null) {

    function SQLSafe(string $s): string {
        return addslashes($s);
    }

    $user_id = SQLSafe($_POST["user_id"]);
    $title = SQLSafe($_POST["title"]);
    $description = SQLSafe($_POST["description"]);
    $type = SQLSafe($_POST["type"]);
    $status = SQLSafe($_POST["status"]);


    $sql = "INSERT INTO request (user_id, title, description, type, status)
        VALUES ('$user_id', '$title', '$description', '$type', '$status')";
    $conn->exec($sql);
    echo $conn->lastInsertId();

} else  {
    header("HTTP/1.1 401 Unauthorized");
}



            ?>