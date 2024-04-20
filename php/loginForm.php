<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container py-4">
    <div class="text-center py-4"> <h3>Continue to Your Account</h3></div>
        <form method="POST" enctype="multipart/form-data" id="loginForm">
            <div class="row justify-content-center">
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" />
                    <div id="email-error" class="text-danger"></div>
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                </div>
                <div class="form-group mb-3 row align-items-center justify-content-center">
                    <button type="submit" class="btn text-dark col-md-5" style="background-color: #ACD3F6;" id="submit-btn">Log in</button>
                </div>
            </div>
        </form>
    </div>    
</body>
</html>
