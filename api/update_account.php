<?php
require_once('../db/database.php');
$conn = Database::getInstance($_SERVER['HTTP_X_API_KEY']);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $conn != null) {
    $Body_Json =  file_get_contents('php://input');
    $Json_data = $obj = json_decode($Body_Json);

    function SQLSafe(string $s): string {
        $NewData = stripslashes($s);
        return addslashes($NewData);
    }

    $UserID = SQLSafe($_POST["UserID"]);
    $UserName = SQLSafe($_POST["UserName"]);
    $Email = SQLSafe($_POST["Email"]);
    $Password = SQLSafe($_POST["Password"]);

    $resultat1 = $conn->query("SELECT * FROM user_db WHERE id = '$UserID'");
    $resultat1->setFetchMode(PDO::FETCH_OBJ);
    while( $UData = $resultat1->fetch() ) 
    {
        $UserData = $UData;
    }

    if($Password == $UserData->password) {
        $sql2 ="UPDATE user_db SET name =? , email =? WHERE id =?";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute([$UserName, $Email, $UserData->id]);
        echo "Account Updated Successfully";
    } else {
        echo "Wrong Password";
    }
} else  {
    header("HTTP/1.1 401 Unauthorized");
}



            ?>