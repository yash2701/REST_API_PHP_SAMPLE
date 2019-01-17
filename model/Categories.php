<?php
class Categories{

    private $conn;
    private $table = "categories";

    //properties
    public $id;
    public $name;
   

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){

        //query
        $query = "SELECT 
                id,
                name,
                created_at
                FROM 
                " . $this->table . " 
                ORDER BY 
                  created_at DESC";
        
        // prepare statemnt
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
?>