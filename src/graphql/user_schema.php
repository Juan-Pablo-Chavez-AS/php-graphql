<?php
use GraphQL\Type\Definition\Type;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use MongoDB\BSON\ObjectId;

require_once './src/controllers/user_controller.php';

$controller = new UserController();

$userType = new ObjectType([
    'name' => 'Customer',
    'description' => 'Customer from json object',
    'fields' => [
        'id' => Type::string(),
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
                'id' => Type::string(),
            ],
            'resolve' => function ($root, $args) use ($controller) {
                return $controller->getAllUsers($root, $args);
            }
        ],
    ],
]);

$mutationType = new ObjectType([
    'name' => 'Mutation',
    'fields' => [
        'createCustomer' => [
            'type' => $userType,
            'args' => [
                'firstname' => Type::string(),
                'lastname' => Type::string(),
                'age' => Type::int(),
            ],
            'resolve' => function ($root, $args) use ($controller) {
                return $controller->createUser($root, $args);
            }
        ],
        'deleteCustomer' => [
            'type' => $userType,
            'args' => [
                'id' => Type::string(),
            ],
            'resolve' => function ($root, $args) use ($controller) {
                return $controller->deleteUser($root, $args);
            }
        ]
    ]
]);