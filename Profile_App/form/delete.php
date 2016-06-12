<?php
require_once("config/mysql_connect_db.php");

if (isset($_GET['emp_id'])) {
    
    $sql='DELETE FROM address WHERE employee_id ='. $_GET['emp_id'];
    mysqli_query($conn,$sql);

	$sql='DELETE FROM employee WHERE id ='.$_GET['emp_id'];
	mysqli_query($conn,$sql);
       
}
header("Location: output.php");
    
?>