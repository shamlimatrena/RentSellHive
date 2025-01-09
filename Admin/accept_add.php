
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Advertisement Request Page</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css">

</head>
<body>

<?php   
     @include '../config.php';
    session_start();

    if(!isset($_SESSION['admin_name']))
    {
        header('location:../login_form.php');
    }

    // 1. get the ID of Admin to be deleted
    $id = $_GET['id'];

// SQL query to insert the row into the destination table
$sql_insert = "INSERT INTO  tbl_final_add SELECT * FROM tbl_product WHERE id = $id";

// Execute the insert query
if ($conn->query($sql_insert) === TRUE) {
    // SQL query to delete the row from the source table
    $sql_delete = "DELETE FROM tbl_product WHERE id = $id";

    // Execute the delete query
    if ($conn->query($sql_delete) === TRUE) {
         $_SESSION['accept'] = "<div class='success'><b >Request Accepted </div>";
        //Redirect to Manage Admin Page
        
         header('location:../Admin/add-req.php');
    } else {
         $_SESSION['accept'] = "<div class='error'><b>Error</div>";
        //Redirect to Manage Admin Page
        
         header('location:../Admin/add-req.php');
    }
} else {
    $_SESSION['accept'] = "<div class='error'><b>Error</div>";
        //Redirect to Manage Admin Page
        
         header('location:../Admin/add-req.php');
}

// Close the connection
$conn->close();

?>
</body>
</html>