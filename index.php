<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
require_once './src/graphql/user_schema.php';

use GraphQL\Server\StandardServer;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;

$schema = new Schema(
    (new SchemaConfig())
    ->setQuery($queryType)
    ->setMutation($mutationType)
);

$server = new StandardServer([
    'schema' => $schema
]);

$server->handleRequest();