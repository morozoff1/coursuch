<?php
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        header("Access-Control-Allow-Methods: POST");
    
        include '../config/database.php';
        include '../objects/books.php';

        $database = new Database();
        $db = $database->getConnection();
        $books = new Books($db);

       
        $books->name = $_POST['name'];
        $books->author = $_POST['author'];
        $books->date = $_POST['date'];
        $books->description = $_POST['description'];

        
            if ($books-> сreateBooks()) {
                http_response_code(201);
                echo json_encode(array("message" => "Книга добавлена."), JSON_UNESCAPED_UNICODE);
            }
            else {
                http_response_code(503);
        
                echo json_encode(array("message" => "Невозможно добавить книгу."), JSON_UNESCAPED_UNICODE);
            }
        
?>