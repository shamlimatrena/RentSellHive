<?php 
@include '../config.php';
session_start();

if(!isset($_SESSION['admin_name']))
{
    header('location:../login_form.php');
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Information and Management</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">

</head>
<body>

    <div class="container-r">

        <div class="content-r">
         
            <a href="../logout_form.php" class="btn">Logout</a>
            <a href="../admin_page.php" class="btn">Main Menu</a>
            <a href="../Admin/man_admin.php" class="btn">Admin Informations</a>
            <a href="../Admin/man_user.php" class="btn">User Information and Management</a>
            <a href="../Admin/Registration_request.php" class="btn">Registration Requests</a>
            <a href="../Admin/buy_rent_req.php" class="btn">Buy and Rent Requests</a>
            <a href="../Admin/add-req.php" class="btn">Advertisement Requests</a>
            

        </div>
        
    </div>
</body>
</html>



<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f1f1f1;
    }

    .container {
        width: 500px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
        text-align: center;
        margin-bottom: 20px;
        margin-top: 150px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        background-color: #f9f9f9;
    }

    .form-group input[type="radio"] {
        margin-right: 5px;
    }

    .form-group input[type="submit"] {
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        background-color: #4CAF50;
        color: #fff;
        cursor: pointer;
    }

    .form-group input[type="submit"]:hover {
        background-color: #45a049;
    }

    .success {
        color: #2ecc71;
    }

    .error {
        color: #e74c3c;
    }
</style>

<div class="container">
    <h2>Add Category</h2>

    <?php 
    if(isset($_SESSION['add']))
    {
        echo '<div class="success">' . $_SESSION['add'] . '</div>';
        unset($_SESSION['add']);
    }

    if(isset($_SESSION['upload']))
    {
        echo '<div class="error">' . $_SESSION['upload'] . '</div>';
        unset($_SESSION['upload']);
    }
    ?>

    <br><br>

    <!-- Add Category Form Starts -->
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" placeholder="Category Title">
        </div>

        <div class="form-group">
            <label for="image">Select Image:</label>
            <input type="file" name="image" id="image">
        </div>

        <div class="form-group">
            <label>Featured:</label>
            <input type="radio" name="featured" value="Yes"> Yes 
            <input type="radio" name="featured" value="No"> No 
        </div>

        <div class="form-group">
            <label>Active:</label>
            <input type="radio" name="active" value="Yes"> Yes 
            <input type="radio" name="active" value="No"> No 
        </div>

        <div class="form-group">
            <input type="submit" name="submit" value="Add Category">
        </div>

    </form>
    <!-- Add Category Form Ends -->

    <?php 
    // Check whether the Submit Button is Clicked or Not
    if(isset($_POST['submit']))
    {
        // Get the Value from Category Form
        $title = $_POST['title'];

        // For Radio input, we need to check whether the button is selected or not
        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];
        }
        else
        {
            $featured = "No";
        }

        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active = "No";
        }

        // Check whether the image is selected or not and set the value for image name accordingly
        if(isset($_FILES['image']['name']))
        {
            // Upload the Image
            // To upload image we need image name, source path, and destination path
            $image_name = $_FILES['image']['name'];

            // Upload the Image only if the image is selected
            if($image_name != "")
            {
                // Auto Rename our Image
                $ext = end(explode('.', $image_name));
                $image_name = "Product_Category_" . rand(000, 999) . '.' . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/" . $image_name;

                // Finally Upload the Image
                $upload = move_uploaded_file($source_path, $destination_path);

                // Check whether the image is uploaded or not
                // If the image is not uploaded, stop the process and redirect with an error message
                if($upload == false)
                {
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                    header('location:../Admin/add-cat.php');
                    die();
                }
            }
        }
        else
        {
            // Don't Upload Image and set the image_name value as blank
            $image_name = "";
        }

        // Create SQL Query to Insert Category into Database
        $sql = "INSERT INTO tbl_category SET 
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'";

        // Execute the Query and Save in Database
        $res = mysqli_query($conn, $sql);

        // Check whether the query executed or not and data added or not
        if($res == true)
        {
            $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
            header('location:../Admin/add-cat.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
            header('location:../Admin/add-cat.php');
        }
    }
    ?>

</div>
</div>
