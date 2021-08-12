<?php
define("servername","localhost");
define("username","sgu");
define("password","k9HhFMRDW1Y5");
define("database","sgu_thanhphp");

class Database{
    private $table;
    private $conn;
    public function __construct()
    {
        $this->conn = new mysqli(servername, username, password, database);
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return mysqli
     */
    public function getConn()
    {
        return $this->conn;
    }

    function checkConnection(){
        if($this->conn->connect_error)
            die("Connection failed: " . $this->conn->connect_error);
    }
    function closeConnection(){
        $this->conn->close();
    }

    function getAll(){
        var_dump($this->table);
        $sql = "SELECT * FROM ".$this->table;
        return $this->conn->query($sql);
    }
    function getAllUser(){
        $sql = "SELECT * FROM ".$this->table." WHERE roles = '0'";
        return $this->conn->query($sql);
    }

    function getByUsername($username){
        $sql = "SELECT * FROM ".$this->table." WHERE username = '$username'";
        return $this->conn->query($sql);
    }
    function getById($id){
        $sql = "SELECT * FROM ".$this->table." WHERE id = '$id'";
        return $this->conn->query($sql);
    }

    function insertUser($firstname, $lastname, $email, $username, $password, $role){
        //find username
        $user = $this->getByUsername($username);

        //check exist
        if($user->num_rows>0){
            return "User has exist!";
        }
        else{
            $pass = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO `Users`(`id`, `firstname`, `lastname`, `email`, `username`, `password`, `roles`) VALUES (null,'$firstname','$lastname','$email','$username','$pass',0)";
            if($this->conn->query($sql)){
                return "Insert data success";
            }
            else{
                return 'Error: '. $this->db->error;
            }
        }


    }

    function updateUser($id, $firstname, $lastname, $email, $username, $password){
        //find username
        $user = $this->getById($id);

        //check exist
        if($user==null){
            return "User not exist!";
        }
        while($row = $user->fetch_assoc()) {
            if ($firstname == '') {
                    $firstname = $row['firstname'];
            }
            if ($lastname == '') {
                $lastname = $row['lastname'];
            }
            if ($email == '') {
                $email = $row['email'];
            }
            if ($username == '') {
                $username = $row['username'];
            }
        }

        if($password == '')
        {
            $sql = "UPDATE ".$this->table ." SET firstname = '$firstname', lastname = '$lastname', email = '$email', username = '$username' WHERE id = '$id'";
            if($this->conn->query($sql)){
                return "Update data success";
            }
            else{
                return 'Error: '. $this->db->error;
            }
        }
        else{
            $pass = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE ".$this->table ." SET firstname = '$firstname', lastname = '$lastname', email = '$email', username = '$username', password = '$pass' WHERE id = '$id'";
            if($this->conn->query($sql)){
                return "Update data success";
            }
            else{
                return 'Error: '. $this->db->error;
            }
        }


    }

    function deleteByUsername($username){
        $sql = "Delete from ".$this->table." WHERE username = '$username'";
        if($this->conn->query($sql)){
            return "Delete data success";
        }
        else{
            return 'Error: '. $this->conn->error;
        }
    }
}


