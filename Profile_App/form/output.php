<?php
/**
 * Display all employee data file.
 */
require_once('config/database_config.php');

//Sql query to display employee data.
$sql_query = " SELECT  employee.id AS emp_id,employee.first_name AS first_name,
        employee.middle_name AS middle_name,employee.last_name AS last_name,
        employee.date_of_birth AS date_of_birth, employee.prefix AS prefix,
        employee.photo AS photo,employee.note AS note, employee.gender AS gender,
        employee.marital_status AS marital, employee.communication AS communication,
        employee.employment AS employment, employee.employer AS employer,
        residence.street AS r_street,residence.city AS r_city, residence.state AS r_state,
        residence.pin_no AS r_pin, residence.phone AS r_phone, residence.fax AS r_fax,
        office.street AS o_street,office.city AS o_city, office.state AS o_state,
        office.pin_no AS o_pin,office.phone AS o_phone,office.fax AS o_fax
    FROM employee
    LEFT JOIN address AS residence
        ON employee.id=residence.employee_id AND residence.type = 'residence'
    LEFT JOIN address AS office
        ON employee.id=office.employee_id AND office.type = 'office'";

$result = mysqli_query($conn,$sql_query);
$num_rows = mysqli_num_rows($result);

//Serial no for employee table.
$serial_no = 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
            name="viewport">
        <title>Employee Details</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/form.css"  />
        <link rel="stylesheet" href="css/output.css"  />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid" id="container_1">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Sanjeeb</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li><a href="form.php">Registration</a></li>
                            <li class="active"><a href="#">Employee Details</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php

                //To check if employee table is empty or not.
                if ($num_rows > 0) {

            ?>
            <div  class="table-responsive">
            <h2>Employee Details</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><h4>Serial No</h4></th>
                            <th><h4>Photo</h4></th>
                            <th><h4>Personal Info</h4></th>
                            <th><h4>Residence Address</h4></th>
                            <th><h4>Office Address</h4></th>
                            <th><h4>Other Info</h4></th>
                            <th><h4>Edit</h4></th>
                            <th><h4>Delete</h4></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo ++$serial_no; ?>
                            </td>
                            <td>
                                <img src="profile_pic/<?php $pic =! empty($row['photo']) ?
                                    $row['photo'] : $row['gender'] . '.jpg' ; echo $pic;?>"
                                    class="img-rounded" alt="profile_pic" width="160"
                                    height="160">
                            </td>
                            <td>
                                <?php echo '<strong>Name:</strong>' . $row['prefix']
                                    . ' ' . $row['first_name'] .' '. $row['middle_name']
                                    .' '. $row['last_name']
                                    . '<br><strong>Gender:</strong>' . $row['gender']
                                    . '<br><strong>DOB:</strong>' .
                                        date('d-M-Y',strtotime($row['date_of_birth'])) .
                                    '<br><strong>Marital Status:</strong>'
                                        . $row['marital'];
                                ?>
                            </td>
                            <td>
                                <?php echo '<strong>Street:</strong>'
                                    . $row['r_street']
                                    . '<br><strong>City:</strong>'
                                    . $row['r_city']
                                    . '<br><strong>State:</strong>'
                                    . $row['r_state']
                                    . '<br><strong>Pin no:</strong>'
                                    . $row['r_pin']
                                    . '<br><strong>Phone no:</strong>'
                                    . $row['r_phone']
                                    . '<br><strong>Fax no:</strong>'
                                    . $row['r_fax'];
                                ?>
                            </td>
                            <td>
                                <?php echo '<strong>Street:</strong>'
                                    . $row['o_street']
                                    . '<br><strong>City:<strong>'
                                    . $row['o_city']
                                    . '<br><strong>State:</strong>'
                                    . $row['o_state']
                                    . '<br><strong>Pin no:</strong>'
                                    . $row['o_pin']
                                    . '<br><strong>Phone no:</strong>'
                                    . $row['o_phone']
                                    . '<br><strong>Fax no:</strong>'
                                    .$row['o_fax'];
                                ?>
                            </td>
                            <td>
                                <?php echo '<strong>Employment:</strong>'
                                    . $row['employment']
                                    . '<br><strong>Employer:</strong>'
                                    . $row['employer']
                                    . '<br><strong>Note:</strong>'
                                    . $row['note']
                                    . '<br><strong>Communication:</strong>'
                                    . $row['communication'];
                                ?>
                            </td>
                            <td>
                                <a href="form.php?emp_id=<?php echo $row['emp_id']?>">
                                    <span class="glyphicon glyphicon-pencil"
                                        aria-hidden="true"></span>
                                </a>
                            </td>
                            <td>
                                <a onclick="return confirm('Are you sure you want to delete this employee?')"
                                    href="delete.php?emp_id=<?php echo $row['emp_id'] . '&photo=' . $row['photo']; ?>">
                                    <span class="glyphicon glyphicon-remove error"
                                        aria-hidden="true"></span>
                                </a>
                            </td>
                         </tr>
                    <?php   } ?>
                    </tbody>
                </table>
            </div>
            <?php } else {?>
            <div class="container">
                <div class="alert alert-danger">
                    <h2>SORRY! NO RECORD FOUND.</h2>
                </div>
            </div>
        <?php }?>
        </div>
    </body>
</html>