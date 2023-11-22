<?php

if ($method == "GET") {
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);

    ob_end_clean();
    echo json_encode([
        "message" => "Get request processed",
        "path" => $mainPath
    ]);
} elseif ($method == "POST") {

    echo json_encode([ "message" => "Post request processed"]);
} elseif ($method == "PUT") {

    echo json_encode([ "message" => "Put request processed"]);
} elseif ($method == "DELETE") {

    echo json_encode([ "message" => "Delete request processed"]);
}
