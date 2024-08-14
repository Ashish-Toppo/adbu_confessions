<?php
class Database {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function authentication($username, $password) {
        $query = "SELECT * FROM `confessions` WHERE `username` = ? AND `password` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            return true;
        }
        return false;
    }

    public function registration($username, $password) {
        $query = "SELECT * FROM `confessions` WHERE `username` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            return false;
        }

        $query = "INSERT INTO `confessions` (`username` ,`password`) VALUES(?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss",$username,$password);
        if($stmt->execute()){
            return true;//successfull registration
        }
        return false;//registration failed
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>
