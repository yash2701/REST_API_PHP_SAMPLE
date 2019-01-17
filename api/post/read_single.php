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

//Get ID fromom URL
$post->id = isset($_GET['id']) ? $_GET['id'] : die();
    
$post->read_single();

$post_arr = array(
    "id" => $post->id,
    "title" => $post->title,
    "body" => $post->body,
    "author" => $post->author,
    "category_name" => $post->category_name
);

// Make JSON
print_r(json_encode($post_arr));
?>