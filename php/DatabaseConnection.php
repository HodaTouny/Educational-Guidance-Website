<?php

class database{
    private $conn;
    
    public function __construct() {
        try {
            $this->conn = mysqli_connect("localhost", "root", "", "educational");
            if (!$this->conn) {
                throw new Exception("Error in connection: " . mysqli_connect_error());
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function checkEmailExistence($email) {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result) > 0;
    }

    public function registerUser($name, $email, $password,$userType) {
        $query = "INSERT INTO users (fullname, email, password, user_type) VALUES ('$name', '$email', '$password', '$userType')";
        return mysqli_query($this->conn, $query);
    }

    public function checkCredentials($email, $password) {
        $query = "SELECT password, user_type,fullname FROM users WHERE email = '$email'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['password'];
            $userType = $row['user_type'];
            $userName = $row['fullname'];
            if ($storedPassword === $password) {
                return array($userType,$userName);
            } else {
                return "";
            }
        } else {
            return "";
        }
    }
    
    public function __destruct(){
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

?>
