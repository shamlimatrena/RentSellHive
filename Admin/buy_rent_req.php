
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
	<title>Buy and Rent Request Page</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">

</head>
<body>

	<div class="container-r">

		<div class="content-r">
			
			
			<p>This Is Buy and Rent  Request Page</p>
            <a href="../logout_form.php" class="btn">Logout</a>
            <a href="../admin_page.php" class="btn">Main Menu</a>
            <a href="../Admin/add-req.php" class="btn">Advertisement Requests</a>
            <a href="../Admin/Registration_request.php" class="btn">Registration Requests</a>
            <a href="../Admin/buy_rent_req.php" class="btn">Buy and Rent Requests</a>
            <a href="../Admin/man_user.php" class="btn">User Information and Management</a>
            <a href="../Admin/man_admin.php" class="btn">Admin Informations</a>

			
			

		</div>
		
	</div>

 <div class="main-content">
            <div class="wrapper">
                <h1>Manage Buy and Rent </h1>

                <br />


<?php
  if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['accept']))
                    {
                        echo $_SESSION['accept'];
                        unset($_SESSION['accept']);
                    }
?>


<table class="tbl-full">
                    <tr>
                    	<th>SI.NO.</th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category-ID</th>
                        <th>Action</th>
                        <th>Type</th>

                    </tr>

                    
                    <?php 

                        //Query to Get all Admin
                        $select = "SELECT * FROM tbl_buy_rent";
                        //Execute the Query
                        $result = mysqli_query($conn, $select);

                        //CHeck whether the Query is Executed or Not
                        if($result==TRUE)
                        {
                            // Count Rows to CHeck whether we have data in database or not
                            $count = mysqli_num_rows($result); // Function to get all the rows in database

                            $sn=1; //Create a Variable and Assign the value

                            //CHeck the num of rows
                            if($count > 0)
                            {
                                //WE HAve data in database
                                while($rows=mysqli_fetch_assoc($result))
                                {
                                    //Using While loop to get all the data from database.
                                    //And while loop will run as long as we have data in database

                                    //Get individual DAta
                                    $id=$rows['id'];
                                    $title=$rows['title'];
                                    $description=$rows['description'];
                                    $price=$rows['price'];
                                    $image = $rows['image_name'];
                                    $categoryid = $rows['category_id'];
                                    $type=$rows['type'];

                                    //Display the Values in our Table
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?>)</td>
                                        <td><?php echo $id; ?>)</td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $description; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $image; ?></td>
                                        <td><?php echo $categoryid; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td>

                                           <a href="../Admin/accept_buy.php?id=<?php echo $id; ?>" class="btn-primary">Accept</a>
                                            <a href="../Admin/deny_buy.php?id=<?php echo $id; ?>" class="btn-secondary">Deny</a>
                                            
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else
                            {
                                echo "The Database Is Empty";
                            }
                        }

                    ?>


                    
                </table>

            </div>
        </div>
        


</body>
</html>