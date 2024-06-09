<?php

class Books
{
    // подключение к базе данных и таблице "products"
    private $conn;

    // свойства объекта
    public $id;
    public $name;
    public $author;
    public $date;
    public $description;

    // конструктор для соединения с базой данных
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function readBooks()
    {
        $query = "SELECT * FROM books";
        $stmt = $this->conn->prepare($query); 
 
            $stmt->execute(); 
 
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            return $result;
    }
    function deleteBooks()
        {

            $query = "DELETE FROM books 
                        WHERE id=:id";

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":id", $this->id);

            if ($stmt->execute()) {
                return true;
            }
                return false;

        }
        function updateBooks()
        {
            $query = "UPDATE books SET name=:name, author=:author, date=:date, description=:description
                        WHERE id=:id";

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->date = htmlspecialchars(strip_tags($this->date));
            $this->description = htmlspecialchars(strip_tags($this->description));

            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":author", $this->author);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":description", $this->description);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
        function сreateBooks()
        {
            $query = "INSERT INTO books SET name=:name, author=:author, date=:date, description=:description";

            $stmt = $this->conn->prepare($query);

           
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->date = htmlspecialchars(strip_tags($this->date));
            $this->description = htmlspecialchars(strip_tags($this->description));
        
            
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":author", $this->author);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":description", $this->description);

        if ($stmt->execute()) {
            return true;
        }
            return false;
        }
}