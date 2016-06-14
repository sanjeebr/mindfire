<?php
require_once("config/mysql_connect_db.php");
if (isset($_GET['emp_id'])) {
    $emp_id = stripslashes($_GET['emp_id']);
    $photo = 'profile_pic/'.stripslashes($_GET['photo']);
    $sql='DELETE FROM address WHERE employee_id ='. $emp_id;
    mysqli_query($conn,$sql);
	$sql='DELETE FROM employee WHERE id ='.$emp_id;
	mysqli_query($conn,$sql);
	unlink($photo);
       
}
header("Location: output.php");
    
?>