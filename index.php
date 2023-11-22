<?php
ob_start();

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER["REQUEST_METHOD"];

if ($method == "GET") {
    $path = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'))[1];

    // $path = "path";

    ob_end_clean();
    echo json_encode([
        "message" => "Get request processed",
        "path" => $path
    ]);
} elseif ($method == "POST") {

    echo json_encode([ "message" => "Post request processed"]);
} elseif ($method == "PUT") {

    echo json_encode([ "message" => "Put request processed"]);
} elseif ($method == "DELETE") {

    echo json_encode([ "message" => "Delete request processed"]);
}

