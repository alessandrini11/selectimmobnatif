<?php
    class User {
        //database config
        private $conn;
        private $table = 'user';

        //properties
        public $id;
        public $nom;
        public $prenom;
        public $email;
        public $password;

        //constructor with database
        public function __construct($db){
            $this->conn = $db;
        }

        //get users
        public function getAll(){
            $query = 'SELECT * from '. $this->table;

            //prepare statement
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            //execute query
            return $stmt;
        }
        public function getSingle(){
            $query = 'SELECT * FROM '. $this->table. ' WHERE id = ?';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->nom = $row['nom'];
            $this->prenom = $row['prenom'];
            $this->email = $row['email'];
            $this->password = $row['password'];
        }

        public function create(){
            $query = 'INSERT INTO  '
                .$this->table. '  
                SET
                    nom = :nom,
                    prenom = :prenom,
                    email = :email,
                    password = :password
            ';
            $stmt = $this->conn->prepare($query);

            $this->nom = htmlspecialchars(strip_tags($this->nom));
            $this->prenom = htmlspecialchars(strip_tags($this->prenom));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));

            $stmt->bindParam(':nom',$this->nom);
            $stmt->bindParam(':prenom',$this->prenom);
            $stmt->bindParam(':email',$this->email);
            $stmt->bindParam(':password',$this->password);

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
                    nom = :nom,
                    prenom = :prenom,
                    email = :email,
                    password = :password
                WHERE 
                    id = :id';
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->nom = htmlspecialchars(strip_tags($this->nom));
            $this->prenom = htmlspecialchars(strip_tags($this->prenom));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));

            $stmt->bindParam(':id',$this->id);
            $stmt->bindParam(':nom',$this->nom);
            $stmt->bindParam(':prenom',$this->prenom);
            $stmt->bindParam(':email',$this->email);
            $stmt->bindParam(':password',$this->password);

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