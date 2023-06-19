<?php
class Update {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function deleteData($id , $nom, $email) {
        $query = "UPDATE utilisateurs SET :nom , :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id" , $id);
        $stmt->bindParam(":nom" , $nom);
        $stmt->bindParam(":email" , $email);
        if($stmt-> execute()) {
            return true;
        } else {
            return false;
        }
    }
}
