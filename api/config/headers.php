<?php
class SetHeaders {
 
    public function __construct() {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header('HTTP/1.0 401 Unauthorized');
            header("Content-Type: application/json; charset=UTF-8");
            echo json_encode([
                "message" => "Basic Authentication required"
                ]);
            die();
        } else {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        }
    }
        
    public function setPostHeaders() {
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
    }
}
?>