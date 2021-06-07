<?php
class Product {
 
    // database connection and table name
    private $conn;
    private $table_name = "products";
 
    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;
    public $modified;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read() {
    
        // select all query
        $query = "SELECT
                    id, name, description, price, created
                FROM
                    " . $this->table_name . "";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }


    // create product
    function create() {
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, price=:price, description=:description, created=:created";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->created = htmlspecialchars(strip_tags($this->created));
    
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":created", $this->created);
    
        // execute query
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
        
    }

    // update the product
    function update() {
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    price = :price,
                    description = :description,
                    modified = :modified
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->modified = htmlspecialchars(strip_tags($this->modified));
        $this->id = htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':modified', $this->modified);
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }

    // delete the product
    function delete() {
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(':id', $this->id);
    
        // execute query
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
        
    }


    // search products
    function search() {
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    name LIKE :name
                ORDER BY
                    created DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $name = htmlspecialchars(strip_tags($this->name));
        $name = "%{$name}%";
    
        // bind
        $stmt->bindParam(':name', $name);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}

