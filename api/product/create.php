<?php
// required headers

 
// get database connection
include_once '../config/headers.php';
include_once '../config/database.php';
include_once '../object/product.php';

//set the headers
$headers = new SetHeaders();
$headers->setPostHeaders();

$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if (
    !empty($data->name) &&
    !empty($data->price) &&
    !empty($data->description)
) {
 
    // set product property values
    $product->name = $data->name;
    $product->price = $data->price;
    $product->description = $data->description;
    $product->created = date('Y-m-d H:i:s');
 
    // create the product
    if ($product->create()) {
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode([
            "message" => "Product was created."
            ]);
    }
 
    // if unable to create the product, tell the user
    else {       
        http_response_code(500);
 
        // tell the user
        echo json_encode([
            "message" => "Unable to create product."
            ]);
    }
}
 
// tell the user data is incomplete
else {
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode([
        "message" => "Unable to create product. Data is incomplete."
        ]);
}
?>