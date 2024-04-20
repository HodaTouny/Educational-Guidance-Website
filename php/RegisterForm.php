<?php
if(isset($_SESSION['user_role'])) {
    $user_role = $_SESSION['user_role'];
}else{
    $user_role = 'guest';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="alertContainer"></div>
<div class="container py-4">
        <div class="text-center py-">
        <?php if($user_role == 'guest'): ?>
            <h3>Set Up Your Profile!</h3>
        <?php elseif($user_role == 'Admin'): ?>
            <h3>Add New Admin Now!</h3>
            <?php endif ?>    
        </div>
        <form method="POST" enctype="multipart/form-data" id="registrationForm">
            <div class="row justify-content-center">
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name"/>
                    <div id="name-error" class="text-danger"></div>
                </div>
                <div class="form-group mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"/>
                    <div id="email-error" class="text-danger"></div>
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                    <div id="password-error" class="text-danger"></div>
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" />
                    <div id="confirm-password-error" class="text-danger"></div>
                </div>
                <div class="form-group mb-3">
                    <input type="hidden" class ="form-control" name="user_type" id="userType" value="<?php echo ($user_role === 'guest') ? 'customer' : 'admin'; ?>">
                    <div id="confirm-password-error" class="text-danger"></div>
                </div>
                <div class="form-group mb-3 row align-items-center justify-content-center">
                    <button type="submit" class="btn text-dark col-md-5" style="background-color: #ACD3F6;" id="submit-btn">Sign Up</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

