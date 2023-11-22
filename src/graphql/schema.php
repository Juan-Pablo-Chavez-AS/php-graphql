<?php
use GraphQL\Type\Definition\Type;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Schema;

$userType = new ObjectType([
    'name' => 'Customer',
    'description' => 'Customer from json object',
    'fields' => [
        'id' => Type::int(),
        'firstname' => Type::string(),
        'lastname' => Type::string(),
        'age' => Type::int(),
    ]
]);

$queryType = new ObjectType([
    'name' => 'Query',
    'fields' => [
        'customer' => [
            'type' => $userType,
            'args' => [
                'id' => Type::int(),
            ],
            'resolve' => function ($root, $args) {
               return ["resolver result"];
            }
        ],
    ],
]);

$schema = new Schema([
    "query" => $queryType
]);
