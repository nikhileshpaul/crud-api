# PHP CRUD API
 A simple crud api endpoints in php using pdo 
 
## Set up the database
Create a new database

Open api/config/database.php and enter your database details.

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "crud_api";
    private $username = "root";
    private $password = "";

Execute all queries in api/config/setup_db.sql to setup the database

## Test API
Open POSTMAN.

IMPORTANT NOTE: Set Authorization type as Basic Auth for all the requests

Below are the endpoints

- GET Methods
    - Read.php
    To read/display all records, make a GET request to 
    http://localhost/crud-api/api/product/read.php

    - Search.php
    To search a record by name, make a GET request like
    http://localhost/crud-api/api/product/search.php?name=Ipad

- POST Methods
    - Create.php
    To create/add a new record, make a POST request to
    http://localhost/crud-api/api/product/create.php
    Select format as "raw" for the request body and enter data in JSON format like below
    **{"name":"Samsung Galaxy S21", "price":"1000", "description":"Samsung Galaxy Phone"}**

    - Update.php
    To update an existing record, make a POST request to
    http://localhost/crud-api/api/product/update.php
    Select format as "raw" for the request body and enter data in JSON format like below
    **{"id":"4", "name":"Samsung Galaxy S21", "price":"2000", "description":"Samsung Galaxy Phone"}**

    - Delete.php
    To delete a record, make a POST request to 
    http://localhost/crud-api/api/product/delete.php
    Select format as "raw" for the request body and enter data in JSON format like below
    **{"id":"4"}**