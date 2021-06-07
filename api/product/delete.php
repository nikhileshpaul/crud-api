<?php

// include database and object file
include_once '../config/headers.php';
include_once '../config/database.php';
include_once '../object/product.php';
 
//set the headers
$headers = new SetHeaders();
$headers->setPostHeaders();

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new Product($db);
 
// get product id
$data = json_decode(file_get_contents("php://input"));
 
// set product id to be deleted
$product->id = $data->id;
 
// delete the product
if ($product->delete()) {
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode([
        "message" => "Product was deleted."
        ]);
}
 
// if unable to delete the product
else {
    http_response_code(500);
 
    // tell the user
    echo json_encode([
        "message" => "Unable to delete product."
        ]);
}
?>