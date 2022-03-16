<?php


class TradeCapabilities
{
    //database config
    private $conn;
    private $table = 'trade_capabilities';

    //properties
    public $id;
    public $trade_id;
    public $capability_id;


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
        $this->trade_id = $row['trade_id'];
        $this->capability_id = $row['capability_id'];
    }

    public function create(){
        $query = 'INSERT INTO  '
            .$this->table. '  
                SET
                    trade_id = :trade_id,
                    capability_id = :capability_id
            ';
        $stmt = $this->conn->prepare($query);

        $this->trade_id = htmlspecialchars(strip_tags($this->trade_id));
        $this->capability_id = htmlspecialchars(strip_tags($this->capability_id));

        $stmt->bindParam(':trade_id',$this->trade_id);
        $stmt->bindParam(':capability_id',$this->capability_id);

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
                    trade_id = :trade_id,
                    capability_id = :capability_id
                WHERE
                    id = :id
            ';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->trade_id = htmlspecialchars(strip_tags($this->trade_id));
        $this->capability_id = htmlspecialchars(strip_tags($this->capability_id));

        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':trade_id',$this->trade_id);
        $stmt->bindParam(':capability_id',$this->capability_id);

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