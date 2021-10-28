<?php

use models\Post;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Origin");

require_once "../../autoload.php";

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $data = json_decode(file_get_contents("php://input"));

    $post = new Post();


    $post->id = htmlspecialchars($data->id);


    if ($post->delete()) {
        echo json_encode(array(
            "status" => true,
            "message" => "Post was deleted successfully"
        ));
    } else {
        echo json_encode(array(
            "status" => false,
            "message" => "Post was not delete"
        ));
    }
} else {
    echo json_encode(array(
        "status" => false,
        "message" => "Method not allowed"
    ));
}
