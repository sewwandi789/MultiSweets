<?php
$error = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'email_exists':
            $error = 'Email already exists. Please use a different email.';
            break;
        case 'password_mismatch':
            $error = 'Passwords do not match. Please try again.';
            break;
        case 'invalid_credentials':
            $error = 'Invalid email or password. Please try again.';
            break;
    }
}

$show_login_form = isset($_GET['form']) && $_GET['form'] == 'login';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $show_login_form ? 'Login' : 'Sign Up' ?> Form</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap" rel="stylesheet">
    <!-- Icon Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">
    <!-- Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .cont {
            width: 900px;
            height: 550px;
            background: #ffffff;
            border-radius: 15px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .form {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form label {
            margin-bottom: 15px;
            display: block;
        }

        .form label span {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        .form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form input:focus {
            border-color: #d4af7a;
            outline: none;
            box-shadow: 0 0 5px rgba(212, 175, 122, 0.5);
        }

        .form .forgot-pass {
            font-size: 12px;
            color: #888;
            text-align: right;
            margin-top: -10px;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .form button {
            background: #d4af7a;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .form button:hover {
            background: #c4956d;
        }

        .sub-cont {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #d4af7a;
            color: #fff;
        }

        .sub-cont h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .img__btn {
            background: #fff;
            color: #d4af7a;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s;
        }

        .img__btn:hover {
            background: #c4956d;
            color: #fff;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
        }

        /* Close Button */
        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #d4af7a;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .close-btn i {
            color: #fff;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="cont">
        <!-- Close Button -->
        <button class="close-btn" onclick="window.location.href='index.php'">
            <i class="bi bi-x"></i>
        </button>

        <!-- Form Toggle (Sign-Up / Login) -->
        <div class="form <?= $show_login_form ? 'login' : 'sign-up' ?>">
            <h2><?= $show_login_form ? 'Login' : 'Create Account' ?></h2>
            <?php if (!empty($error)): ?>
                <p class="error-message"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <?php if ($show_login_form): ?>
                <form action="query/login.php" method="POST">
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" required>
                    </label>
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" required>
                    </label>
                    <button type="submit">Login</button>
                </form>
                <div class="forgot-pass">
                    <a href="?form=signup">Don't have an account? Sign up</a>
                </div>
            <?php else: ?>
                <form action="query/signup.php" method="POST">
                    <label>
                        <span>Full Name</span>
                        <input type="text" name="name" required>
                    </label>
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" required>
                    </label>
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" required>
                    </label>
                    <label>
                        <span>Confirm Password</span>
                        <input type="password" name="confirm_password" required>
                    </label>
                    <button type="submit">Sign Up</button>
                </form>
                <div class="forgot-pass">
                    <a href="?form=login">Already have an account? Login</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right-Side Image/Text -->
        <div class="sub-cont">
            <h3><?= $show_login_form ? 'New User?' : 'Already have an account?' ?></h3>
            <p><?= $show_login_form ? 'Sign up to join us!' : 'Sign in to continue your journey!' ?></p>
            <a href="?form=<?= $show_login_form ? 'signup' : 'login' ?>" class="img__btn"><?= $show_login_form ? 'Sign Up' : 'Sign In' ?></a>
        </div>
    </div>
</body>
</html>
