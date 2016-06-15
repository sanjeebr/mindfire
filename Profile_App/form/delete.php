<?php
/**
 * Delete employee data file.
 */

require_once('config/database_config.php');

if (isset($_GET['emp_id']) && preg_match('/^[0-9]*$/',$_GET['emp_id'])) {
    $emp_id = stripslashes($_GET['emp_id']);
    $photo = 'profile_pic/'.stripslashes($_GET['photo']);

    // Delete data from address table
    $sql='DELETE FROM address WHERE employee_id ='. $emp_id;
    mysqli_query($conn,$sql);

    // Delete data from employee table
	$sql='DELETE FROM employee WHERE id ='.$emp_id;
	mysqli_query($conn,$sql);

    // Delete profile pic
    unlink($photo);
}

header('Location: output.php');
