<?php 
$prefix=$_POST['prefix'];
$first_name=$_POST['first_name'];
$middle_name=$_POST['middle_name'];
$last_name=$_POST['last_name'];
$gender=$_POST['gender'];
$date_of_birth=$_POST['date_of_birth'];
$marital=$_POST['marital'];
$r_street=$_POST['r_street'];
$r_city=$_POST['r_city'];
$r_state=$_POST['r_state'];
$r_pin=$_POST['r_pin'];
$r_phone=$_POST['r_phone'];
$o_fax=$_POST['r_fax'];
$o_street=$_POST['o_street'];
$o_city=$_POST['o_city'];
$o_state=$_POST['o_state'];
$o_pin=$_POST['o_pin'];
$o_phone=$_POST['o_phone'];
$o_fax=$_POST['o_fax'];
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Registration</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/output.css"  />
</head>
<body>
    <div class="container">
         <?php echo "<h2>Personal Info:</h2><br>
         <h3>Name: $prefix $first_name $middle_name $last_name<br>
         Gender:$gender<br>
         Date of Birth:$date_of_birth<br>
         Marital Status:$marital<br></h3>
         <h2>Residence Address:</h2>
         <h3>$r_street,$r_city,$r_state</h3>
         <h3>Pin no:$r_pin</h3>
         <h3>Phone no:$r_phone</h3>
         <h3>Fax no:$r_fax</h3>
         <h2>Office Address:</h2>
         <h3>$o_street,$o_city,$o_state</h3>
         <h3>Pin no:$o_pin</h3>
         <h3>Phone no:$o_phone</h3>
         <h3>Fax no:$o_fax</h3>

         "; 



         ?> 
    </div> 
</body>
</html>
