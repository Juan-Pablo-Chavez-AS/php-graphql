<?php
ob_start();

require_once __DIR__ . '/vendor/autoload.php';

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER["REQUEST_METHOD"];
$paths = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
$mainPath = $paths[1];

// include 'src/config/database.php';

if ($mainPath === "users") {
    include 'src/user.php';
    exit();
}

http_response_code(404);
echo json_encode(array("message" => "Not Found"));
