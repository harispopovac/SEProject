<?php

require 'flight/Flight.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=gymapp_db','root',''));

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


//trainers
Flight::route('GET /trainers', function(){
    $skip = Flight::request()->query['skip'];
    $limit = Flight::request()->query['limit'];

    if(!$skip || !is_numeric($skip)) $skip = 0;
    if(!$limit || !is_numeric($limit) || $limit < $skip || $limit > 200) $limit = $skip + 20;

    $get = "SELECT * FROM trainers LIMIT {$skip}, {$limit}";
    
    $stmt = Flight::db()->prepare($get);
    $stmt->execute();
    $trainers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($trainers);
});

Flight::route('GET /trainers/@id', function($id){
    
    $get = "SELECT * FROM trainers WHERE id = {$id}";
    
    $stmt = Flight::db()->prepare($get);
    $stmt->execute();
    $trainer = $stmt->fetch(PDO::FETCH_ASSOC);
    Flight::json($trainer);
});

Flight::route('POST /trainers', function(){
    
    $request = Flight::request()->data->getData();
    // return name;
    // return Flight::json($request);
    $insert = "INSERT INTO trainers (name, basic_info, email) VALUES(:name, :basic_info, :email)";
    $stmt= Flight::db()->prepare($insert);
    $stmt->execute($request);
});

Flight::route('PUT /trainers/@id', function($id){
    $request = Flight::request()->data->getData();
    $request['id'] = $id;

    $update = "UPDATE trainers SET name = :name, basic_info = :basic_info, email = :email WHERE id = :id";
    
    $stmt= Flight::db()->prepare($update);
    $stmt->execute($request);
});

Flight::route('DELETE /trainers/@id', function($id){
    $request = Flight::request()->data->getData();
    $request['id'] = $id;

    $delete = "DELETE FROM trainers WHERE id = :id";
    
    $stmt= Flight::db()->prepare($delete);
    $stmt->execute(["id" => $id]);
});
//shop

Flight::route('GET /products', function(){
    $skip = Flight::request()->query['skip'];
    $limit = Flight::request()->query['limit'];

    if(!$skip || !is_numeric($skip)) $skip = 0;
    if(!$limit || !is_numeric($limit) || $limit < $skip || $limit > 200) $limit = $skip + 20;

    $get = "SELECT * FROM products LIMIT {$skip}, {$limit}";
    
    $stmt = Flight::db()->prepare($get);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($products);
});

Flight::route('GET /products/@id', function($id){
    
    $get = "SELECT * FROM products WHERE id = {$id}";
    
    $stmt = Flight::db()->prepare($get);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    Flight::json($product);
});

Flight::route('POST /products', function(){
    
    $request = Flight::request()->data->getData();
    // return name;
    // return Flight::json($request);
    $insert = "INSERT INTO products (name, description, price) VALUES(:name, :description, :price)";
    $stmt= Flight::db()->prepare($insert);
    $stmt->execute($request);
});

Flight::route('PUT /products/@id', function($id){
    $request = Flight::request()->data->getData();
    $request['id'] = $id;

    $update = "UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id";
    
    $stmt= Flight::db()->prepare($update);
    $stmt->execute($request);
});

Flight::route('DELETE /products/@id', function($id){
    $request = Flight::request()->data->getData();
    $request['id'] = $id;

    $delete = "DELETE FROM products WHERE id = :id";
    
    $stmt= Flight::db()->prepare($delete);
    $stmt->execute(["id" => $id]);
});

//offer
Flight::route('GET /offers', function(){
    $skip = Flight::request()->query['skip'];
    $limit = Flight::request()->query['limit'];

    if(!$skip || !is_numeric($skip)) $skip = 0;
    if(!$limit || !is_numeric($limit) || $limit < $skip || $limit > 200) $limit = $skip + 20;

    $get = "SELECT * FROM offers LIMIT {$skip}, {$limit}";
    
    $stmt = Flight::db()->prepare($get);
    $stmt->execute();
    $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($offers);
});

Flight::route('GET /offers/@id', function($id){
    
    $get = "SELECT * FROM offers WHERE id = {$id}";
    
    $stmt = Flight::db()->prepare($get);
    $stmt->execute();
    $offer = $stmt->fetch(PDO::FETCH_ASSOC);
    Flight::json($offer);
});

Flight::route('POST /offers', function(){
    
    $request = Flight::request()->data->getData();
    // return name;
    // return Flight::json($request);
    $insert = "INSERT INTO offers (name, description, price) VALUES(:name, :description, :price)";
    $stmt= Flight::db()->prepare($insert);
    $stmt->execute($request);
});

Flight::route('PUT /offers/@id', function($id){
    $request = Flight::request()->data->getData();
    $request['id'] = $id;

    $update = "UPDATE offers SET name = :name, description = :description, price = :price WHERE id = :id";
    
    $stmt= Flight::db()->prepare($update);
    $stmt->execute($request);
});

Flight::route('DELETE /offers/@id', function($id){
    $request = Flight::request()->data->getData();
    $request['id'] = $id;

    $delete = "DELETE FROM offers WHERE id = :id";
    
    $stmt= Flight::db()->prepare($delete);
    $stmt->execute(["id" => $id]);
});

Flight::start();


?>