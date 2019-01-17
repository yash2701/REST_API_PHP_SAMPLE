<?php 
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Conetent_Type: application/JSON');

    include_once '../../config/Database.php';
    include_once '../../model/post.php';  

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $post = new Post($db);

    //Blog post query
    $result = $post->read();

    //Get row count
    $num = $result->rowCount();

    // Check if any posts
    if($num > 0){
        //posts array
        $posts_arr = array();
        $posts_arr["data"] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item = array(
                "id" => $id,
                "title" => $title,
                "body" => html_entity_decode($body),
                "author" => $author,
                "category_name" => $category_name
            );

            //pust to data
            array_push($posts_arr["data"], $post_item);            
        }
        //Turn to JSON & Output
        echo json_encode($posts_arr);
    }
    else{
        // No posts
        echo json_encode(
            array("message" => "NO POST FOUND")
        );
    }
?>