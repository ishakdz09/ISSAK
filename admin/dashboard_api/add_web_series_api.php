<?php
require '../../db/config.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Body_Json =  file_get_contents('php://input');
    $Json_data = $obj = json_decode($Body_Json);

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            function SQLSafe(string $s): string {
                return addslashes($s);
            }

            $TMDB_ID = SQLSafe($Json_data->TMDB_ID);
            $Name = SQLSafe($Json_data->name);
            $Description = SQLSafe($Json_data->description);
            $genres = SQLSafe($Json_data->genres);
            $release_date = SQLSafe($Json_data->release_date);


            $sql = "INSERT INTO web_series (TMDB_ID, name, description, genres, release_date, poster, banner, youtube_trailer, downloadable, type, status)
                                        VALUES ('$TMDB_ID', '$Name', '$Description', '$genres', '$release_date', '$Json_data->poster', '$Json_data->banner', '$Json_data->youtube_trailer', '$Json_data->downloadable', '$Json_data->type', '$Json_data->status')";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo $conn->lastInsertId();
            
    
} else  {
    header("HTTP/1.1 401 Unauthorized");
}



            ?>