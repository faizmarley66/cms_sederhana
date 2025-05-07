<?php
session_start();
require_once 'config/database.php';

$db_error = null;
$pdo_available = true;

// Cek koneksi database
if (!isset($pdo)) {
    $db_error = "Database connection not available";
    $pdo_available = false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Jika tombol force login ditekan
    if (isset($_POST['force_login'])) {
        $_SESSION['user_id'] = 0;
        $_SESSION['username'] = 'DemoUser';
        header("Location: index.php");
        exit();
    }
    // Jika koneksi database tersedia, proses login normal
    if ($pdo_available) {
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
            background: rgba(0, 0, 0, 0.92);
            border-radius: 18px;
            box-shadow: 0 0 30px 0 rgba(139,0,0,0.7);
            animation: fadeIn 0.7s cubic-bezier(.4,0,.2,1);
            border: 2px solid #8B0000;
        }
        .login-logo {
            margin-bottom: 18px;
            text-align: center;
        }
        .login-logo a {
            font-size: 30px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .login-logo b {
            color: #ff0000;
        }
        .login-card-body {
            padding: 32px 28px 24px 28px;
            border-radius: 12px;
            background: rgba(0, 0, 0, 0.85);
        }
        .input-group {
            margin-bottom: 18px;
        }
        .input-group-text {
            background: #8B0000;
            border: none;
            color: white;
        }
        .form-control {
            background: rgba(255,255,255,0.08);
            border: 1.5px solid #8B0000;
            color: white;
            padding: 13px;
            height: auto;
            border-radius: 7px;
        }
        .form-control:focus {
            background: rgba(255,255,255,0.15);
            border-color: #ff0000;
            box-shadow: 0 0 0 0.2rem rgba(139,0,0,0.18);
            color: white;
        }
        .form-control::placeholder {
            color: rgba(255,255,255,0.5);
        }
        .btn-primary {
            background: #8B0000;
            border: none;
            padding: 13px;
            font-size: 17px;
            font-weight: bold;
            border-radius: 7px;
            transition: all 0.3s cubic-bezier(.4,0,.2,1);
        }
        .btn-primary:hover {
            background: #ff0000;
            transform: translateY(-2px) scale(1.03);
        }
        .btn-danger {
            background: #ff0000;
            border: none;
            padding: 13px;
            font-size: 17px;
            font-weight: bold;
            border-radius: 7px;
            margin-top: 8px;
            transition: all 0.3s cubic-bezier(.4,0,.2,1);
        }
        .btn-danger:hover {
            background: #8B0000;
            color: #fff;
            transform: translateY(-2px) scale(1.03);
        }
        .alert {
            border-radius: 8px;
            margin-bottom: 18px;
            background: rgba(139,0,0,0.18);
            border: 1.5px solid #8B0000;
            color: #ff0000;
            font-size: 15px;
        }
        .alert-success {
            background: rgba(0,128,0,0.18);
            border: 1.5px solid #008000;
            color: #00ff00;
        }
        .alert-db {
            background: rgba(255,0,0,0.13);
            border: 1.5px solid #ff0000;
            color: #fff;
            font-weight: bold;
            text-align: center;
            font-size: 16px;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .login-box-msg {
            font-size: 19px;
            color: #fff;
            margin-bottom: 22px;
            text-align: center;
        }
        .brand-image {
            width: 80px;
            height: 80px;
            margin-bottom: 13px;
            filter: brightness(0) invert(1);
        }
        .card {
            background: transparent;
            border: none;
        }
        .register-link {
            color: #fff;
            text-align: center;
            margin-top: 15px;
        }
        .register-link a {
            color: #ff0000;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
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

            <?php if ($db_error): ?>
                <div class="alert alert-db">
                    <i class="fas fa-database"></i> <?php echo $db_error; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username" required <?php if(!$pdo_available) echo 'disabled'; ?>>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" required <?php if(!$pdo_available) echo 'disabled'; ?>>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" <?php if(!$pdo_available) echo 'disabled'; ?>>
                            <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                        </button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <button type="submit" name="force_login" class="btn btn-danger btn-block">
                            <i class="fas fa-bolt"></i> Force Login (Demo)
                        </button>
                    </div>
                </div>
            </form>

            <div class="register-link">
                Don't have an account? <a href="register.php">Register here</a>
            </div>
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