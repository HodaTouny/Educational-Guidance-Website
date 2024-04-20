<?php
session_start();

if(isset($_SESSION['user_role'])) {
    $user_role = $_SESSION['user_role'];
    $user_name = $_SESSION['user_name'];
} else {
    $user_role = 'guest';
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'logout') {
    $_SESSION = array();
    session_destroy();
    echo json_encode(array("status" => "success"));
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../css/Custom.css" rel="stylesheet">
</head>
<body>
    <div class="bg-black">
        <div class="container">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 mb-2">
                <!-- Navbar First part -->
                <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-decoration-none">
                    <img src="../assets/logo.png" height="65" role="img" class="pb-2">
                </a>

                <!-- Navbar Middle-Part -->
                <?php if($user_role == 'Admin'): ?>
                    <ul class="nav col-12 col-md-auto justify-content-center mb-md-0 text-white">
                        <li><a href="#" class="nav-link">New Course</a></li>
                        <li><a href="AddAdmin.php" class="nav-link">New Admin</a></li>
                    </ul>
                <?php else: ?>
                    <ul class="nav col-12 col-md-auto justify-content-center mb-md-0 text-white">
                        <li><a href="Home.php" class="nav-link">Home</a></li>
                        <li><a href="#" class="nav-link">About</a></li>
                    </ul>
                <?php endif; ?> 

                 <!-- Navbar Last-Part -->
                <div class="col-md-3 text-end">
                    <?php if($user_role == 'guest'): ?>
                        <button type="button" class="btn btn-light text-dark me-2 login" onclick="redirectTo('login')">Login</button>
                        <button type="button" class="btn custombtn" onclick="redirectTo('signup')">Sign-up</button>  
                    <?php elseif($user_role == 'customer' || $user_role == 'Admin'): ?>
                        <div class="dropdown-center">
                            <button class="btn btn-outline-dark custombtn dropdown-toggle fw-semibold" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $user_name ?></button>
                            <ul class="dropdown-menu">
                            <?php if($user_role == 'customer'):?>
                                <li><a class="dropdown-item" href="#">profile</a></li>
                            <?php endif;?>
                                <li><a class="dropdown-item" href="#" onclick = "logout()">Log out</a></li>
                            </ul>
                        </div>    
                    <?php endif; ?>
                </div>
            </header>
        </div>
    </div>
    <script src="../Bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../javascript/Header.js"></script>
</body>
</html>
