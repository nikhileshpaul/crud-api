<?php
 
// include database and object files
include_once '../config/headers.php';
include_once '../config/database.php';
include_once '../object/product.php';
 
//set the headers
$headers = new SetHeaders();

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new Product($db);
 
// get keywords
$product->name = isset($_GET["name"]) ? $_GET["name"] : "";
 
// query products
$stmt = $product->search();
$num = $stmt->rowCount();
 
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
 
    // show products data
    echo json_encode($products_arr);
}
 
else {
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode([
        "message" => "No products found."
        ]);
}
?>