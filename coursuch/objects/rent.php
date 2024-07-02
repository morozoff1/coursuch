<?php

class Rent
{
    // подключение к базе данных и таблице "products"
    private $conn;

    // свойства объекта
    public $id;
    public $bookid;

    // конструктор для соединения с базой данных
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function readRent(){
        $query = "SELECT * FROM rent";
        $stmt = $this->conn->prepare($query); 
                $stmt->execute(); 
     
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
                return $result;
    }
    function createRent(){
        $query = "INSERT INTO rent SET bookid=:bookid"; 
 
            $stmt = $this->conn->prepare($query); 
 
            
            $this->bookid = htmlspecialchars(strip_tags($this->bookid)); 
           
           
             
             
            $stmt->bindParam(":bookid", $this->bookid); 
             
            
 
 
        if ($stmt->execute()) { 
            return true; 
        } 
            return false;
}

}