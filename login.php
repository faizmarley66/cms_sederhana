<?php
session_start();
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - CMS Sederhana</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #000000, #8B0000);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            width: 400px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(139, 0, 0, 0.5);
            animation: fadeIn 0.5s ease-in-out;
            border: 1px solid #8B0000;
        }
        .login-logo {
            margin-bottom: 20px;
            text-align: center;
        }
        .login-logo a {
            font-size: 28px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        .login-logo b {
            color: #ff0000;
        }
        .login-card-body {
            padding: 30px;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.8);
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group-text {
            background: #8B0000;
            border: none;
            color: white;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #8B0000;
            color: white;
            padding: 12px;
            height: auto;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #ff0000;
            box-shadow: 0 0 0 0.2rem rgba(139, 0, 0, 0.25);
            color: white;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        .btn-primary {
            background: #8B0000;
            border: none;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #ff0000;
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
            background: rgba(139, 0, 0, 0.2);
            border: 1px solid #8B0000;
            color: #ff0000;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .login-box-msg {
            font-size: 18px;
            color: #fff;
            margin-bottom: 25px;
            text-align: center;
        }
        .brand-image {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
            filter: brightness(0) invert(1);
        }
        .card {
            background: transparent;
            border: none;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image">
        <a href="#"><b>CMS</b> Sederhana</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Welcome Back! Please Sign In</p>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html> 