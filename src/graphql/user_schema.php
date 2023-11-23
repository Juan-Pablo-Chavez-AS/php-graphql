<?php
use GraphQL\Type\Definition\Type;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;

use MongoDB\BSON\ObjectId;

require_once './src/config/database.php';

$mongoClient = DBConnection::getInstance();

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
            'resolve' => function ($root, $args) use ($mongoClient) {
                // $cursor = $mongoClient->demo->customer->find();
                // $documents = $cursor->toArray();

                // if (!empty($documents)) {
                //     $firstDocument = $documents[0];
                //     return $firstDocument;
                // } else {
                //     return null;
                // }

                try {
                    $filter = ['id' => new ObjectId($args['id'])];
                    $cursor = $mongoClient->demo->customer->findOne($filter);

                    if ($cursor === null) {
                        throw new Exception('Documento no encontrado. ID: ' . $args['id']);
                    }

                    var_dump($args['id']);
                    var_dump($cursor);

                    return $cursor->toArray()[0];
                } catch (Exception $e) {
                    // Manejar el error, por ejemplo, devolver un mensaje de error o lanzar una excepción GraphQL
                    error_log($e->getMessage());
                    var_dump($mongoClient->demo->customer->find()->toArray());  // Imprimir todos los documentos en la colección
                    return null;
                }
            }
        ],
    ],
]);

$schema = new Schema(
    (new SchemaConfig())
    ->setQuery($queryType)
);
