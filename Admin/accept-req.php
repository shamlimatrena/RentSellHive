
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
$sql_insert = "INSERT INTO  user_admin_info SELECT * FROM req_reg WHERE id = $id";

// Execute the insert query
if ($conn->query($sql_insert) === TRUE) {
    // SQL query to delete the row from the source table
    $sql_delete = "DELETE FROM req_reg WHERE id = $id";

    // Execute the delete query
    if ($conn->query($sql_delete) === TRUE) {
         $_SESSION['accept'] = "<div class='success'><b >Request Accepted </div>";
        //Redirect to Manage Admin Page
        
         header('location:../Admin/Registration_request.php');
    } else {
         $_SESSION['accept'] = "<div class='error'><b>Error</div>";
        //Redirect to Manage Admin Page
        
         header('location:../Admin/Registration_request.php');
    }
} else {
    $_SESSION['accept'] = "<div class='error'><b>Error</div>";
        //Redirect to Manage Admin Page
        
         header('location:../Admin/Registration_request.php');
}

// Close the connection
$conn->close();

?>
