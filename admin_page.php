<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name']))
{
    header('location:login_form.php');
}



$totalRevenue = 0;
$sql = "SELECT SUM(price) AS total FROM tbl_buy_rent_con";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $totalRevenue = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>


        body {
            background-color: skyblue;
            font-family: Arial, sans-serif;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);

                        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;

        }

        .container {
            width: 1500px;
            margin: 0 auto;
            padding: 20px;
            background-color: blue;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
                background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradient 10s ease infinite;

        }



@keyframes gradient {
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


        .content {
            text-align: center;
        }

        h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        span {
            color: #ff4081;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            background-color: #ff4081;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #e64a8e;
        }

      .total-revenue {
            position: absolute;
            top: 20px;
            right: 500px;
            font-size: 18px;
            color: darkblue;
                        width: 11em;
            border: 3px solid darkblue;
            box-shadow: 9px 6px 4px #5B2C6F;
            padding: 7px 11px;
            background-image: linear-gradient(150deg, skyblue ,  60%, skyblue);

        }
    </style>
</head>
<body>
        <div class="total-revenue">
                Total Revenue: <?php echo $totalRevenue; ?>
            </div>


    <div class="container">
        <div class="content">
            <h3>Hi <span><?php echo $_SESSION['admin_name'] ?></span></h3>
            <p>Welcome to the Admin Dashboard</p>

            <a href="Admin/Registration_request.php" class="btn">Registration Requests</a>
            <a href="Admin/man_admin.php" class="btn">Admin Informations</a>
            <a href="Admin/man_user.php" class="btn">User Information and Management</a>
            <a href="Admin/add-cat.php" class="btn">Add Category</a>
            <a href="Admin/add-req.php" class="btn">Advertisement Requests</a>
            <a href="Admin/buy_rent_req.php" class="btn">Buy and Rent Requests</a>
            <a href="logout_form.php" class="btn">Logout</a>
        </div>
    </div>
</body>
</html>
