<?php

/**
 * Delete employee data file.
 */

require_once('config/database_config.php');
require_once('config/constants.php');

if (isset($_GET['emp_id']) && preg_match('/^[0-9]*$/', $_GET['emp_id'])) {
    $emp_id = stripslashes($_GET['emp_id']);

    // TODO: To use employee id instead of fetching from GET parameter
    $photo = PROFILE_PIC . stripslashes($_GET['photo']);

    // Delete data from address table
    $sql = "DELETE FROM address WHERE employee_id = $emp_id";
    $result = mysqli_query($conn, $sql);

    if (FALSE === $result) {
        header('Location: error.php');
    }

    // Delete data from employee table.
	$sql = "DELETE FROM employee WHERE id = $emp_id";
	$result = mysqli_query($conn, $sql);

    if (FALSE === $result) {
        header('Location: error.php');
    }

    // Delete profile pic
    unlink($photo);
}

header('Location: employee.php');
