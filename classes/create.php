<?php
class Create {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function createData($nom , $email) {
        $query = "INSERT INTO utilisateurs (nom , email) VALUES (:nom , :email)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nom" , $nom);
        $stmt->bindParam(":email" , $email);
        if ($stmt-> execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->execute();
        return $stmt;
    }
}

?>