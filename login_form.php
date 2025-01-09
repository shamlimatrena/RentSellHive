<?php
@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select = " SELECT * FROM user_admin_info WHERE email = '$email' && password = '$pass' ";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_id'] = $row['id'];
            header('location:user_page.php');
        }
    } else {
        $error[] = 'Incorrect email or password! OR Your account is not verified yet';
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login_form</title>
    <style>
        /* CSS Styling */

        body {
            background-color: #f1f1f1;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: inline-flex;
            align-items: stretch;
            height: 100vh;
        }

        .form_cont {
            flex: 2;
            opacity: 0;
            transform: translateY(20px);
            animation: slideIn 0.5s forwards;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 10px 0px 10px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h3 {
            margin-top: 0;
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .error-msg {
            display: block;
            color: red;
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: 50%;
            padding: 15px;
            margin-left: 380px;
            margin-bottom: 100px;
            border: none;
            border-radius: 20px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="email"],
        input[type="password"] {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            color: #555;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #555;
        }

        p a {
            color: crimson;
            text-decoration: none;
        }



        /* Animation */
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .form_cont {
            background: linear-gradient(45deg, #1d9fe7, #8a4fff, #e84fb6);
            background-size: 500% 500%;
            animation: gradientAnimation 4s ease infinite;
        }

        .form-btn {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .form-btn::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.4);
            z-index: -1;
            transition: left 0.3s ease;
        }

        .form-btn:hover::after {
            left: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form_cont">
        <form action="" method="post">

            <h3>Login Now</h3>

            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>

            <input type="email" name="email" required placeholder="Enter your email">

            <input type="password" name="password" required placeholder="Enter your password">

            <input type="submit" name="submit" value="Login" class="form-btn">

            <p>Don't have an account? <a href="register_form.php">Register now</a></p>

        </form>
    </div>
    <div class="image-section"></div>
</div>

<!-- JavaScript Animation -->
<script>
    window.addEventListener('DOMContentLoaded', function () {
        var formCont = document.querySelector('.form_cont');
        formCont.style.opacity = '1';
        formCont.style.transform = 'translateY(0)';
    });
</script>

</body>
</html>
