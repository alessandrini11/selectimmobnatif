<?php


class Location
{
    //database config
    private $conn;
    private $table = 'location';

    //properties
    public $id;
    public $name;
    public $description;
    public $ts_creation;
    public $user_creation;
    public $ts_update;
    public $user_update;
    public $metropolis_id;


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
        $this->name = $row['name'];
        $this->description = $row['description'];
        $this->ts_creation = $row['ts_creation'];
        $this->ts_update = $row['ts_update'];
        $this->user_update = $row['user_update'];
        $this->user_creation = $row['user_creation'];
        $this->metropolis_id = $row['metropolis_id'];
    }

    public function create(){
        $query = 'INSERT INTO  '
            .$this->table. '  
                SET
                    name = :name,
                    description = :description,
                    ts_creation = :ts_creation,
                    user_creation = :user_creation,
                    ts_update = :ts_update,
                    user_update = :user_update,
                    metropolis_id = :metropolis_id
            ';
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->ts_creation = htmlspecialchars(strip_tags($this->ts_creation));
        $this->user_creation = htmlspecialchars(strip_tags($this->user_creation));
        $this->ts_update = htmlspecialchars(strip_tags($this->ts_update));
        $this->user_update = htmlspecialchars(strip_tags($this->user_update));
        $this->metropolis_id = htmlspecialchars(strip_tags($this->metropolis_id));

        $stmt->bindParam(':name',$this->name);
        $stmt->bindParam(':description',$this->description);
        $stmt->bindParam(':ts_creation',$this->ts_creation);
        $stmt->bindParam(':user_update',$this->user_update);
        $stmt->bindParam(':ts_update',$this->ts_update);
        $stmt->bindParam(':user_creation',$this->user_creation);
        $stmt->bindParam(':metropolis_id',$this->metropolis_id);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function update(){
        $query = 'UPDATE  '
            .$this->table. '  
                SET
                    name = :name,
                    description = :description,
                    ts_creation = :ts_creation,
                    user_creation = :user_creation,
                    ts_update = :ts_update,
                    user_update = :user_update,
                    metropolis_id = :metropolis_id
                
                WHERE
                    id = :id
            ';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->ts_creation = htmlspecialchars(strip_tags($this->ts_creation));
        $this->user_creation = htmlspecialchars(strip_tags($this->user_creation));
        $this->ts_update = htmlspecialchars(strip_tags($this->ts_update));
        $this->user_update = htmlspecialchars(strip_tags($this->user_update));
        $this->metropolis_id = htmlspecialchars(strip_tags($this->metropolis_id));

        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':name',$this->name);
        $stmt->bindParam(':description',$this->description);
        $stmt->bindParam(':ts_creation',$this->ts_creation);
        $stmt->bindParam(':user_update',$this->user_update);
        $stmt->bindParam(':ts_update',$this->ts_update);
        $stmt->bindParam(':user_creation',$this->user_creation);
        $stmt->bindParam(':metropolis_id',$this->metropolis_id);

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