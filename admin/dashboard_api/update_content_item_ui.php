<?php
require '../../db/config.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Body_Json =  file_get_contents('php://input');
    $Json_data = $obj = json_decode($Body_Json);

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            function SQLSafe(string $s): string {
                $NewData = stripslashes($s);
                return addslashes($NewData);
            }

            $MW_Item_Type = $Json_data->MW_Item_Type;
            $LT_Item_Type = $Json_data->LT_Item_Type;

            $sql ="UPDATE config SET content_item_type =?, live_tv_content_item_type=? WHERE id =1";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$MW_Item_Type, $LT_Item_Type]);

            echo "Content Item UI Updated successfully";
            
    
} else  {
    header("HTTP/1.1 401 Unauthorized");
}



            ?>