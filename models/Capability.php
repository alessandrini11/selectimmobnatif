<?php


class Capability
{
    //database config
    private $conn;
    private $table = 'capability';

    //properties
    public $id;
    public $label;
    public $ts_creation;
    public $user_creation;
    public $ts_update;
    public $user_update;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll(){
        $query = 'SELECT * FROM  '. $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getSingle(){
        $query = 'SELECT * FROM '. $this->table. ' WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        //bind parameter
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        //associates attributes
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->label = $row['label'];
        $this->ts_creation = $row['ts_creation'];
        $this->ts_update = $row['ts_update'];
        $this->user_update = $row['user_update'];
        $this->user_creation = $row['user_creation'];
    }

    public function create(){
        $query = 'INSERT INTO  '
            .$this->table. '  
                SET
                    label = :label,
                    ts_creation = :ts_creation,
                    user_creation = :user_creation,
                    ts_update = :ts_update,
                    user_update = :user_update
            ';
        $stmt = $this->conn->prepare($query);

        $this->label = htmlspecialchars(strip_tags($this->label));
        $this->ts_creation = htmlspecialchars(strip_tags($this->ts_creation));
        $this->user_creation = htmlspecialchars(strip_tags($this->user_creation));
        $this->ts_update = htmlspecialchars(strip_tags($this->ts_update));
        $this->user_update = htmlspecialchars(strip_tags($this->user_update));

        $stmt->bindParam(':label',$this->label);
        $stmt->bindParam(':ts_creation',$this->ts_creation);
        $stmt->bindParam(':user_update',$this->user_update);
        $stmt->bindParam(':ts_update',$this->ts_update);
        $stmt->bindParam(':user_creation',$this->user_creation);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function update(){
        $query = 'UPDATE '
            .$this->table. '  
                SET
                    label = :label,
                    ts_creation = :ts_creation,
                    user_creation = :user_creation,
                    ts_update = :ts_update,
                    user_update = :user_update
                WHERE 
                    id = :id';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->label = htmlspecialchars(strip_tags($this->label));
        $this->ts_creation = htmlspecialchars(strip_tags($this->ts_creation));
        $this->user_creation = htmlspecialchars(strip_tags($this->user_creation));
        $this->ts_update = htmlspecialchars(strip_tags($this->ts_update));
        $this->user_update = htmlspecialchars(strip_tags($this->user_update));

        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':label',$this->label);
        $stmt->bindParam(':ts_creation',$this->ts_creation);
        $stmt->bindParam(':user_update',$this->user_update);
        $stmt->bindParam(':ts_update',$this->ts_update);
        $stmt->bindParam(':user_creation',$this->user_creation);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function delete(){
        $query = 'DELETE  FROM ' .$this->table. ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id',$this->id);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

}