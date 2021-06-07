<?php

// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../object/product.php';
include_once '../config/headers.php';

//set the headers
$headers = new SetHeaders();
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new Product($db);

// query products
if ($product->read()) {
$stmt = $product->read();
$num = $stmt->rowCount();

}

// check if more than 0 record found
if ($num > 0) {
 
    // products array
    $products_arr = [];
    $products_arr["records"] = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);
 
        $product_item = array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price
        ); 
        array_push($products_arr["records"], $product_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($products_arr);
}
 
// no products found will be here
else {
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode([
        "message" => "No products found."
        ]);
}