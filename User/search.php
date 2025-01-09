<?php
    @include '../config.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('location:login_form.php');
        exit;
    }
    $id = $_SESSION['user_id'];

    // Handle search form submission
    if (isset($_POST['search'])) {
        $searchTerm = $_POST['searchTerm'];
        // Fetch images with 'featured' and 'active' both set to 'Yes' and matching title
        $sql = "SELECT * FROM tbl_final_add WHERE featured = 'Yes' AND active = 'Yes' AND title LIKE '%$searchTerm%'";
        $result = mysqli_query($conn, $sql);
    } else {
        // Fetch all images with 'featured' and 'active' both set to 'Yes'
        $sql = "SELECT * FROM tbl_final_add WHERE featured = 'Yes' AND active = 'Yes'";
        $result = mysqli_query($conn, $sql);
    }
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Interface</title>
  <link rel="stylesheet" type="text/css" href="../css/user.css">
  <style>
body
{
  background-color: darkblue;
}
    .image-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    .image-container .item {
      margin: 20px;
      text-align: center;
      border-radius: 8px;
      background-color: #222;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      transition: transform 0.3s ease-in-out;
    }
    .image-container .item:hover {
      transform: scale(1.05);
    }
    .image-container .item img {
      width: 200px;
      height: 200px;
      object-fit: cover;
      border: none;
      border-radius: 5px;
    }
    .image-container .item h4 {
      margin: 10px 0;
      color: #fff;
    }
    .image-container .item .buttons {
      margin-top: 10px;
    }
    .image-container .item .buttons a {
      display: inline-block;
      padding: 10px 20px;
      margin: 5px;
      font-size: 16px;
      font-weight: bold;
      text-decoration: none;
      border-radius: 5px;
      background-color: #3e8e41;
      color: #fff;
      transition: background-color 0.3s ease-in-out;
    }
    .image-container .item .buttons a:hover {
      background-color: #367a37;
    }

    /* Search bar styles */
    .search-container {
     margin: 50px auto;
      text-align: center;
      color: silver;

    }
    .search-container input[type="text"] {
      padding: 10px;
      border-radius: 10px;
      border: none;
      outline: none;
      font-size: 16px;
    }
    .search-container button {
      padding: 10px 20px;
      margin-left: 10px;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      background-color: #3e8e41;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }
    .search-container button:hover {
      background-color: #367a37;
    }





    #header {
      background-color: deepskyblue;
      color: #fff;
      padding: 20px;
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




    
  </style>
  <script>
    window.addEventListener("DOMContentLoaded", () => {
      const items = document.querySelectorAll(".item");

      items.forEach((item) => {
        item.addEventListener("mouseover", () => {
          item.style.backgroundColor = "silver";
        });

        item.addEventListener("mouseout", () => {
          item.style.backgroundColor = "#008080";
        });
      });
    });
  </script>
</head>
<body>
  <div id="header">
    <div id="left-section">
      <h3>Hello <span><?php echo $_SESSION['user_name']; ?></span></h3>
    </div>
    <ul id="options">
      <li><a href="../User/Advertisement.php">Give Advertisement</a></li>
       
      <li><a href="../User/search.php">Search Product</a></li>
      <li><a href="../User/profile.php?id=<?php echo $id; ?>">Profile</a></li>
      <li><a href="../logout_form.php">Logout</a></li>
    </ul>
  </div>

  <div class="search-container">
    <form method="POST" action="">
      <input type="text" name="searchTerm" placeholder="Search by title">
      <button type="submit" name="search">Search</button>
    </form>
  </div>

  <div class="image-container">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="item">
        <img src="../images/product/<?php echo $row['image_name']; ?>" alt="Product Image">
        <h4><?php echo $row['title']; ?></h4>
        <p><?php echo $row['description']; ?></p>
        <?php if ($row['type'] == 'Sell'): ?>
          <div class="buttons">
            <a href="User/sell.php?id=<?php echo $row['id']; ?>">Buy</a>
          </div>
        <?php elseif ($row['type'] == 'Rent'): ?>
          <div class="buttons">
           <a href="User/rent.php?id=<?php echo $row['id']; ?>">Rent</a>
          </div>
        <?php elseif ($row['type'] == 'Rent and Sell'): ?>
          <div class="buttons">
          <a href="User/rent.php?id=<?php echo $row['id']; ?>">Rent</a>
          </div>
          <div class="buttons">
            <a href="User/sell.php?id=<?php echo $row['id']; ?>">Buy</a>
          </div>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
