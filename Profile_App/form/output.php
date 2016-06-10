<?php
include_once("php/mysql_connect_db.php");
$sql_query="SELECT  employee.id as emp_id,employee.first_name as first_name, employee.middle_name as middle_name, employee.last_name as last_name, employee.date_of_birth as date_of_birth, employee.prefix as prefix, employee.photo as photo, employee.note as note, employee.gender as gender, employee.marital_status as marital, employee.communication as communication, employee.employment as employment, employee.employer as employer,residence.street as r_street,residence.city as r_city,residence.pin_no as r_pin,residence.phone as r_phone,residence.fax as r_fax,office.street as o_street,office.city as o_city,office.pin_no as o_pin,office.phone as o_phone,office.fax as o_fax FROM employee left join address as residence on employee.id=residence.employee_id and residence.type='residence' left join address as office on employee.id=office.employee_id and office.type='office'";
     
  $result=mysqli_query($conn,$sql_query);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Employee Details</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/output.css"  />
</head>
<body>
    <div class="container-fluid">
  <h2>Employee Details</h2>           
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Emp ID</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Date of Birth</th>
        <th>Marital Status</th>
        <th>Residence Address</th>
        <th>Office Address</th>
        <th>Employment</th>
        <th>Employer</th>
        <th>Extra Note</th>
        <th>Communication Medium</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row=mysqli_fetch_assoc($result)){ ?>
      <tr>
        <td><h3><?php echo $row['emp_id']; ?></h3></td>
        <td><?php echo $row['prefix'].' '.$row['first_name'].' '.$row['middle_name'].' '.$row['Last_name']; ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td><?php echo $row['date_of_birth']; ?></td>
        <td><?php echo $row['marital']; ?></td>
        <td><?php echo $row['r_street'].' ,'.$row['r_city'].','.$row['r_state'].'<br>'.'Pin no:'.$row['r_pin'].'<br>'.'Phone no:'.$row['r_phone'].'<br>'.'Fax no:'.$row['r_fax']; ?></td>
        <td><?php echo $row['o_street'].' ,'.$row['o_city'].','.$row['o_state'].'<br>'.'Pin no:'.$row['o_pin'].'<br>'.'Phone no:'.$row['o_phone'].'<br>'.'Fax no:'.$row['o_fax']; ?></td>
        <td><?php echo $row['employment']; ?></td>
        <td><?php echo $row['employer']; ?></td>
        <td><?php echo $row['note']; ?></td>
        <td><?php echo $row['communication']; ?></td>
      </tr>
     <?php   } ?>
    </tbody>
  </table>
</div> 
</body>
</html>
