<?php
    header("X-Content-Type-Options: nosniff"); 
    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8"); 
    header("Access-Control-Max-Age: 3600"); 
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
include '../config/database.php'; 
include '../objects/rent.php'; 
 
    $database = new Database(); 
    $db = $database->getConnection(); 
    $rent = new Rent($db); 
 
    $result = $rent->readRent(); 
    $num = sizeof($result); 
 
    if ($num > 0) { 
        http_response_code(200); 
        echo json_encode($result,JSON_UNESCAPED_UNICODE); 
    } 
    else { 
        http_response_code(404); 
        echo json_encode(array("message" => "Нет брони."), JSON_UNESCAPED_UNICODE); 
    }
?>