<?php

use models\Post;

require_once "../../autoload.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Origin");

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    echo json_encode(array(
        "status" => false,
        "message" => "Request method is not supported. This endpoint supports only GET requests."
    ));

    die();
}

if (isset($_GET['id'])) {
    $post = new Post();
    $result = $post->show($_GET['id']);

    if ($result->rowCount() > 0) {
        $response = $result->fetch(PDO::FETCH_ASSOC);
        echo json_encode($response);
    } else {
        echo json_encode(array(
            "status" => false,
            "message" => "Post does not exist"
        ));
    }
} else {
    echo json_encode(array(
        "status" => false,
        "message" => "Query parameter id is required."
    ));
}
