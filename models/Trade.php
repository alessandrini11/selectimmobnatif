<?php


class Trade
{
    //database config
    private $conn;
    private $table = 'trade';

    //properties
    public $id;
    public $location_id;
    public $gallery_id;
    public $id_trade;
    public $price;
    public $currency;
    public $title;
    public $agreement;
    public $completed;
    public $type;
    public $ts_creation;
    public $ts_update;
    public $user_creation;
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
        $this->location_id = $row['location_id'];
        $this->gallery_id = $row['gallery_id'];
        $this->id_trade = $row['id_trade'];
        $this->price = $row['price'];
        $this->currency = $row['currency'];
        $this->title = $row['title'];
        $this->agreement = $row['agreement'];
        $this->completed = $row['completed'];
        $this->type = $row['type'];
        $this->ts_creation = $row['ts_creation'];
        $this->user_creation = $row['user_creation'];
        $this->ts_update = $row['ts_update'];
        $this->user_update = $row['user_update'];
    }

    public function create(){
        $query = 'INSERT INTO  '
            .$this->table. '  
                SET
                    location_id = :location_id,
                    gallery_id = :gallery_id,
                    id_trade = :id_trade,
                    price = :price,
                    currency = :currency,
                    title = :title,
                    agreement = :agreement,
                    completed = :completed,
                    type = :type,
                    ts_creation = :ts_creation,
                    user_creation = :user_creation,
                    ts_update = :ts_update,
                    user_update = :user_update
            ';
        $stmt = $this->conn->prepare($query);

        $this->location_id = htmlspecialchars(strip_tags($this->location_id));
        $this->gallery_id = htmlspecialchars(strip_tags($this->gallery_id));
        $this->id_trade = htmlspecialchars(strip_tags($this->id_trade));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->currency = htmlspecialchars(strip_tags($this->currency));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->agreement = htmlspecialchars(strip_tags($this->agreement));
        $this->completed = htmlspecialchars(strip_tags($this->completed));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->ts_creation = htmlspecialchars(strip_tags($this->ts_creation));
        $this->user_creation = htmlspecialchars(strip_tags($this->user_creation));
        $this->ts_update = htmlspecialchars(strip_tags($this->ts_update));
        $this->user_update = htmlspecialchars(strip_tags($this->user_update));

        $stmt->bindParam(':location_id',$this->location_id);
        $stmt->bindParam(':gallery_id',$this->gallery_id);
        $stmt->bindParam(':id_trade',$this->id_trade);
        $stmt->bindParam(':price',$this->price);
        $stmt->bindParam(':currency',$this->currency);
        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':agreement',$this->agreement);
        $stmt->bindParam(':completed',$this->completed);
        $stmt->bindParam(':type',$this->type);
        $stmt->bindParam(':ts_creation',$this->ts_creation);
        $stmt->bindParam(':user_creation',$this->user_creation);
        $stmt->bindParam(':ts_update',$this->ts_update);
        $stmt->bindParam(':user_update',$this->user_update);

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
                    location_id = :location_id,
                    gallery_id = :gallery_id,
                    id_trade = :id_trade,
                    price = :price,
                    currency = :currency,
                    title = :title,
                    agreement = :agreement,
                    completed = :completed,
                    type = :type,
                    ts_creation = :ts_creation,
                    user_creation = :user_creation,
                    ts_update = :ts_update,
                    user_update = :user_update
                WHERE
                    id = :id
            ';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->location_id = htmlspecialchars(strip_tags($this->location_id));
        $this->gallery_id = htmlspecialchars(strip_tags($this->gallery_id));
        $this->id_trade = htmlspecialchars(strip_tags($this->id_trade));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->currency = htmlspecialchars(strip_tags($this->currency));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->agreement = htmlspecialchars(strip_tags($this->agreement));
        $this->completed = htmlspecialchars(strip_tags($this->completed));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->ts_creation = htmlspecialchars(strip_tags($this->ts_creation));
        $this->user_creation = htmlspecialchars(strip_tags($this->user_creation));
        $this->ts_update = htmlspecialchars(strip_tags($this->ts_update));
        $this->user_update = htmlspecialchars(strip_tags($this->user_update));

        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':location_id',$this->location_id);
        $stmt->bindParam(':gallery_id',$this->gallery_id);
        $stmt->bindParam(':id_trade',$this->id_trade);
        $stmt->bindParam(':price',$this->price);
        $stmt->bindParam(':currency',$this->currency);
        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':agreement',$this->agreement);
        $stmt->bindParam(':completed',$this->completed);
        $stmt->bindParam(':type',$this->type);
        $stmt->bindParam(':ts_creation',$this->ts_creation);
        $stmt->bindParam(':user_creation',$this->user_creation);
        $stmt->bindParam(':ts_update',$this->ts_update);
        $stmt->bindParam(':user_update',$this->user_update);

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