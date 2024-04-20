<?php
include 'Header.php';
include 'AuthunticationController.php';

if(isset($_GET['type'])) {
    $type = $_GET['type'];
} else {
    $type = 'login';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authentication</title>
    <script src="../javascript/Form.js"></script>
</head>
<body>
    <div class="container" style="margin-bottom: 4rem;">
    <div id="alertContainer"></div>
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="img">
                    <img src="../assets/sign.png" alt="Logo"/>   
                </div>
            </div>
             <div class="col-md-6 d-flex justify-content-center align-items-center">
                <?php if($type === 'signup'){ include 'RegisterForm.php';}else{include 'loginForm.php';}?>                
            </div>
        </div>
    </div>            
</body>
</html>