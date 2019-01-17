<?php 
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Conetent_Type: application/JSON');

    include_once '../../config/Database.php';
    include_once '../../model/Categories.php';  

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $cat = new Categories($db);

    //Blog post query
    $result = $cat->read();

    //Get row count
    $num = $result->rowCount();

    // Check if any category
    if($num > 0){
        //posts array
        $cat_arr = array();
        $cat_arr["data"] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $cat_item = array(
                "id" => $id,
                "name" => $name,
            );

            //pust to data
            array_push($cat_arr["data"], $cat_item);            
        }
        //Turn to JSON & Output
        echo json_encode($cat_arr);
    }
    else{
        // No Catefories.
        echo json_encode(
            array("message" => "NO CATEGORIES FOUND")
        );
    }
?>