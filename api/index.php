<?php
console.log("AAaaa");

require '../vendor/autoload.php';

console.log("AAaaa");
Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=gymapp_db','haris',''));


Flight::route('GET /gyms', function(){
    $skip = Flight::request()->query['skip'];
    $limit = Flight::request()->query['limit'];

    if(!$skip || !is_numeric($skip)) $skip = 0;
    if(!$limit || !is_numeric($limit) || $limit < $skip || $limit > 200) $limit = $skip + 20;

    $get = "SELECT * FROM gyms LIMIT {$skip}, {$limit}";
    
    $stmt = Flight::db()->prepare($get);
    $stmt->execute();
    $gyms = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($gyms);
});

Flight::route('GET /gyms/@id', function($id){
    
    $get = "SELECT * FROM gyms WHERE id = {$id}";
    
    $stmt = Flight::db()->prepare($get);
    $stmt->execute();
    $gym = $stmt->fetch(PDO::FETCH_ASSOC);
    Flight::json($gym);
});

Flight::route('POST /gyms', function(){
    console.log();
    $request = Flight::request()->data->getData();
    // return name;
    // return Flight::json($request);
    $insert = "INSERT INTO gyms (name, address, basic_info) VALUES(:name, :address, :basic_info)";
    $stmt= Flight::db()->prepare($insert);
    $stmt->execute($request);
});

Flight::route('PUT /gyms/@id', function($id){
    $request = Flight::request()->data->getData();
    $request['id'] = $id;

    $update = "UPDATE gyms SET name = :name, address = :address, basic_info = :basic_info WHERE id = :id";
    
    $stmt= Flight::db()->prepare($update);
    $stmt->execute($request);
});

Flight::route('DELETE /gyms/@id', function($id){
    $request = Flight::request()->data->getData();
    $request['id'] = $id;

    $delete = "DELETE FROM gyms WHERE id = :id";
    
    $stmt= Flight::db()->prepare($delete);
    $stmt->execute(["id" => $id]);
});

Flight::start();
?>
