<?php

use GraphQL\GraphQL;
use MongoDB\BSON\ObjectId;

include_once './src/config/database.php';
include_once './src/controllers/user_controller.php';

class UserController {
    private $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function getAllUsers($root, $args){
        $db = $this->db;
        $filter = ['_id' => new MongoDB\BSON\ObjectId($args['id'])];
        $cursor = $db->demo->customer->findOne($filter);
        $documents = $cursor->getArrayCopy();

        if (!empty($documents)) {
            return
                [
                    'id' => $documents['_id'],
                    'firstname' => $documents['firstname'],
                    'lastname' => $documents['lastname'],
                    'age' => $documents['age'],
                ];
        } else {
            return null;
        }
    }

    public function createUser($root, $args){
        $db = $this->db;
        $document = [
            'firstname' => $args['firstname'],
            'lastname' => $args['lastname'],
            'age' => $args['age'],
        ];
        $insertOneResult = $db->demo->customer->insertOne($document);
        $insertedId = $insertOneResult->getInsertedId();

        $filter = ['_id' => $insertedId];
        $cursor = $db->demo->customer->findOne($filter);
        $documents = $cursor->getArrayCopy();

        if (!empty($documents)) {
            return
                [
                    'id' => $documents['_id'],
                    'firstname' => $documents['firstname'],
                    'lastname' => $documents['lastname'],
                    'age' => $documents['age'],
                ];
        } else {
            return null;
        }
    }

    public function deleteUser($root, $args){
        $db = $this->db;
        $filter = ['_id' => new MongoDB\BSON\ObjectId($args['id'])];
        $cursor = $db->demo->customer->findOne($filter);
        $documents = $cursor->getArrayCopy();

        if (!empty($documents)) {
            $db->demo->customer->deleteOne($filter);
            return
                [
                    'id' => $documents['_id'],
                    'firstname' => $documents['firstname'],
                    'lastname' => $documents['lastname'],
                    'age' => $documents['age'],
                ];
        } else {
            return null;
        }
    }
}