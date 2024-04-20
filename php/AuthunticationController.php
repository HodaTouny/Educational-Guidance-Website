<?php

include "DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $user_type = $_POST["user_type"];

        if ($database->checkEmailExistence($email)) {
            echo json_encode(array("status" => "error", "message" => "Email already exists."));
            exit;
        } else {
            $registered = $database->registerUser($name, $email, $password,$user_type);
            if ($registered) {
                echo json_encode(array("status" => "success", "message" => "Registration successful."));
                exit;
            } else {
                echo json_encode(array("status" => "error", "message" => "Registration failed. Please try again later."));
                exit;
            }
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'login') {
        session_start();
        $email = $_POST["email"];
        $password = $_POST["password"];

        $credentials = $database->checkCredentials($email, $password);
        if (!empty($credentials)) {
            $_SESSION['user_role'] = $credentials[0];
            $_SESSION['user_name'] = ucwords($credentials[1]);
            echo json_encode(array("redirect" => "Home.php"));
            exit;
        } else {
            echo json_encode(array("status" => "error", "message" => "Wrong Credentials, Please try again."));
            exit;
        }
    }
}
?>
