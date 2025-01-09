<?php
@include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $nid =  $_POST['nid'];
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM req_reg WHERE email = '$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        if ($pass != $cpass) {
            $error[] = 'Passwords do not match!';
        } else {
            $insert = "INSERT INTO req_reg(nid, name, email, password, user_type) VALUES('$nid', '$name', '$email', '$pass', '$user_type')";
            mysqli_query($conn, $insert);
            header('location:login_form.php');
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Form</title>
    <style>
        /* CSS Styling */

        body {
            background-color: blue;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .form_cont {
            width: 700px;
            height: 700px;
            margin: 100px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            opacity: 0;
            transform: translateY(20px);
            animation: slideIn 0.5s forwards;
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

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="password"],
        select,
        input[type="submit"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 30px;
            border: none;
            border-radius: 20px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            color: #555;
            transition: box-shadow 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus,
        input[type="password"]:focus,
        select:focus {
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
            background-color: green;
        }

        p {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #555;
        }

        p a {
            color: #4CAF50;
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

<div class="form_cont">
    <form action="" method="post">
        <h3>Fill Up the Form</h3>

        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            }
        }
        ?>

        <input type="text" name="name" required placeholder="Enter your name">
        <input type="email" name="email" required placeholder="Enter your email">
        <input type="number" name="nid" required placeholder="Enter your NID number">
        <input type="password" name="password" required placeholder="Enter your password">
        <input type="password" name="cpassword" required placeholder="Confirm your password">

        <select name="user_type">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <input type="submit" name="submit" value="Register now" class="form-btn">

        <p>Already have an account? <a href="login_form.php">Login</a></p>
    </form>
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
