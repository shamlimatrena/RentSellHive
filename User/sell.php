
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Advertisement Request Page</title>
<link rel="stylesheet" type="text/css" href="../css/user.css">

</head>
<body>


<?php   
     @include '../config.php';
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        header('location:../login_form.php');
    }

    $id = $_GET['id'];


$sql_insert = "INSERT INTO  tbl_buy_rent SELECT * FROM tbl_final_add WHERE id = $id";

if ($conn->query($sql_insert) === TRUE) {

         $_SESSION['buy'] = "<div class='success'><b > Buy Request Sent </div>";
      
        
         header('location:../user_page.php');

} 

else
 {
    $_SESSION['buy'] = "<div class='error'><b>Error</div>";
     
        
         header('location:../user_page.php');
}

$conn->close();

?>
</body>
</html>

