<?php
session_start();

function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container {
            max-width: 400px;
            margin-top: 100px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        a{
            text-decoration: none;
            color:blue;
        }
    </style>

        <script>
                function validateForm() {
                    var password = document.getElementById("password").value;
                    var confirmPassword = document.getElementById("re-enter_password").value;
                    if (password !== confirmPassword) {
                        alert("Passwords do not match.");
                        return false;
                    }
                    return true;
                }
        </script>
    
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="login-container bg-light">
            <h2 class="text-center">SignUp</h2>

            <form action="../server/register.php" method="POST" onsubmit="return validateForm();">

                <?php if (isset($_GET['error']) && $_GET['error'] == 'user_already_exists'): ?>
                    <div class="alert alert-danger" role="alert">
                        Username already exists.
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['error']) && $_GET['error'] == 'csrf_error'): ?>
                    <div class="alert alert-danger" role="alert">
                        Invalid CSRF Token.
                    </div>
                <?php endif; ?>


                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="re-enter_password">Re-enter Password</label>
                    <input type="password" class="form-control" id="re-enter_password" name="re-enter_password" required>
                </div>

              

                <!-- <a href="signup.php">Don't have an account? Sign up.</a>
                <br/> -->
                <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                <button type="submit" class="btn btn-primary btn-block" name='register'>Register</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
