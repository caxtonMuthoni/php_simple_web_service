<?php

use models\Post;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Origin");

require_once "../../autoload.php";

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $data = json_decode(file_get_contents("php://input"));

    $post = new Post();


    $post->id = htmlspecialchars($data->id);
    $post->title = htmlspecialchars($data->title);
    $post->body = htmlspecialchars($data->body);
    $post->author = htmlspecialchars($data->author);
    $post->category_id = htmlspecialchars($data->category_id);

    if ($post->update()) {
        echo json_encode(array(
            "status" => true,
            "message" => "Post was updated successfully"
        ));
    } else {
        echo json_encode(array(
            "status" => false,
            "message" => "Post was not update"
        ));
    }
} else {
    echo json_encode(array(
        "status" => false,
        "message" => "Method not allowed"
    ));
}
