<?php
@include '../config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:../login_form.php');
}

if (isset($_SESSION['add'])) {
    echo '<div class="success">' . $_SESSION['add'] . '</div>';
    unset($_SESSION['add']);
}

$id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Advertisement</title>
    <link rel="stylesheet" type="text/css" href="../css/user.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <style>
    

    #header {
      background-color: deepskyblue;
      color: #fff;
      padding: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    #header #left-section h3 {
      font-size: 24px;
    }
    #header ul {
      list-style: none;
      display: flex;
      align-items: center;
    }
    #header ul li {
      margin-right: 20px;
    }
    #header ul li a {
      text-decoration: none;
      color: #fff;
      font-size: 16px;
      transition: color 0.3s ease-in-out;
    }
    #header ul li a:hover {
      color: black;
    }

    /* Animation styles */
    @keyframes slideIn {
      from {
        transform: translateY(-100%);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }
    #header {
      animation: slideIn 0.5s ease-in-out;
    }
    .success
    {
        color: green;
    }

</style>
    <script>
        // JavaScript animation
        window.addEventListener("DOMContentLoaded", () => {
            const header = document.getElementById("header");
            header.style.animation = "slideIn 0.4s ease-in-out";
        });
    </script>
</head>
<body>
<div id="header">
    <div id="left-section">
    </div>
    <ul id="options">
        <li><a href="../user_page.php">Home</a></li>
        <li><a href="../User/search.php">Search Product</a></li>
        <li><a href="../logout_form.php">Logout</a></li>
    </ul>
    <span id="typing"></span>
</div>
<div id="content">
    <!-- Add your content here -->
</div>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Advertisement</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Title of the Product"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description of the Product. Also add your phone number and location"></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" placeholder="Price of the Product."></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes' and featured='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='$id'>$title</option>";
                                }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Type: </td>
                    <td>
                        <input type="radio" name="type" value="Rent"> Rent
                        <input type="radio" name="type" value="Sell"> Sell
                        <input type="radio" name="type" value="Rent and Sell"> Both (Rent and Sell)
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Product" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $type = $_POST['type'];

            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    $file_parts = explode('.', $image_name);
                    $ext = end($file_parts);
                    $image_name = "product-Name-" . rand(0000, 9999) . "." . $ext;
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/product/" . $image_name;
                    $upload = move_uploaded_file($src, $dst);
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:../User/Advertisement.php');
                        die();
                    }
                }
            } else {
                $image_name = "";
            }

            $sql2 = "INSERT INTO tbl_product SET 
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active',
                type = '$type'
            ";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION['add'] = "<div class='success'>Product Added Successfully. Your product will be visible when an Admin will approve it. Thank you.</div>";
                // header('location:../user_page.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Add Product.</div>";
                // header('location:../user_page.php');
            }
        }
        ?>
    </div>
</div>
</body>
</html>
