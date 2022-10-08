<?php

require_once('../../../db/database.php');
$conn = Database::getInstance($_SERVER['HTTP_X_API_KEY']);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $conn != null) {

    $Body_Json =  file_get_contents('php://input');

    $Json_data = $obj = json_decode($Body_Json);


            function SQLSafe(string $s): string {

                return addslashes($s);

            }

            $modal_plan_name = SQLSafe($Json_data->modal_plan_name);
            $modal_time = SQLSafe($Json_data->modal_time);
            $modal_ammount = SQLSafe($Json_data->modal_ammount);
            $modal_currency = SQLSafe($Json_data->modal_currency);
            $modal_bg_image_url = SQLSafe($Json_data->modal_bg_image_url);
            $f_Subscription_Type = SQLSafe($Json_data->f_Subscription_Type);
            $Publish_toggle_int = SQLSafe($Json_data->Publish_toggle_int);





            $sql = "INSERT INTO subscription (name, time, amount, currency, background, subscription_type, status)

                VALUES ('$modal_plan_name', '$modal_time', '$modal_ammount', '$modal_currency', '$modal_bg_image_url', '$f_Subscription_Type', '$Publish_toggle_int')";

            // use exec() because no results are returned

            $conn->exec($sql);

            echo $conn->lastInsertId();

            

    

} else  {

    header("HTTP/1.1 401 Unauthorized");

}







            ?>