<?php

use GraphQL\GraphQL;
include 'src\graphql\schema.php';

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);

if ($method == "GET") {

} elseif ($method == "POST") {

    try {
        $variableValues = isset($input['variables']) ? $input['variables'] : null;
        $variableValues=[];
        $result = GraphQL::executeQuery($schema, $input['query'], null, null, $variableValues);
        $output = $result->toArray();

        } catch (\Exception $e) {
            $output = [
                'error' => [
                    'message' => $e->getMessage()
                    ]
                ];
        }
        ob_end_clean();
        echo json_encode([
            "message" => "Get request processed",
            "input" => $input,
            "output" => $output,
            "s" => $schema
        ]);
} elseif ($method == "PUT") {

    echo json_encode([ "message" => "Put request processed"]);
} elseif ($method == "DELETE") {

    echo json_encode([ "message" => "Delete request processed"]);
}
