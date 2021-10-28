<?php

use models\Post;

require_once "../../autoload.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    echo json_encode(array(
        "status" => false,
        "message" => "Request method is not supported. This endpoint supports only GET requests."
    ));

    die();
}

$post = new Post();

$result = $post->all();

$reponse = array();

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($reponse, $row);
    }

    echo json_encode($reponse);
} else {
    echo json_encode(array(
        "status" => false,
        "message" => "No posts found"
    ));
}
