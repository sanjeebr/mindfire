<?php

require_once("config/mysql_connect_db.php");

$sql_query="SELECT  employee.id as emp_id,employee.first_name as first_name, 
employee.middle_name as middle_name, employee.last_name as last_name,
 employee.date_of_birth as date_of_birth, employee.prefix as prefix, employee.photo as photo,
  employee.note as note, employee.gender as gender, employee.marital_status as marital, 
  employee.communication as communication, employee.employment as employment,
   employee.employer as employer,residence.street as r_street,residence.city as r_city,
   residence.state as r_state,residence.pin_no as r_pin,residence.phone as r_phone,
   residence.fax as r_fax,office.street as o_street,office.city as o_city,office.state as o_state,
   office.pin_no as o_pin,office.phone as o_phone,office.fax as o_fax
  FROM employee 
  LEFT JOIN address as residence on employee.id=residence.employee_id and residence.type='residence'
  LEFT JOIN address as office on employee.id=office.employee_id and office.type='office'";
     
  $result=mysqli_query($conn,$sql_query);
  $num_rows = mysqli_num_rows($result);

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
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
<?php /* to check record is present or not*/if($num_rows > 0) {?>
    <div  class="table-responsive">

  <h2>Employee Details</h2>           
  <table class="table table-striped">
    <thead>
      <tr>
        <th><h4>Emp ID</h4></th>
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
    <?php while($row=mysqli_fetch_assoc($result)){ ?>
      <tr>
        <td><?php echo $row['emp_id']; ?></td>
        <td><img src="profile_pic/<?php echo $row['photo'];?>" class="img-rounded" alt="profile_pic" width="160" height="160"></td>
        <td><?php echo 'Name:'.$row['prefix'].' '.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'<br>Gender:'.$row['gender'].'<br>DOB:'.date('d-M-Y',strtotime($row['date_of_birth'])).'<br>Marital Status:'. $row['marital']; ?></td>
        <td><?php echo 'Street:'.$row['r_street'].'<br>City:'.$row['r_city'].'<br>State:'.$row['r_state'].'<br>'.'Pin no:'.$row['r_pin'].'<br>'.'Phone no:'.$row['r_phone'].'<br>'.'Fax no:'.$row['r_fax']; ?></td>
        <td><?php echo 'Street:'.$row['o_street'].'<br>City:'.$row['o_city'].'<br>State:'.$row['o_state'].'<br>'.'Pin no:'.$row['o_pin'].'<br>'.'Phone no:'.$row['o_phone'].'<br>'.'Fax no:'.$row['o_fax']; ?></td>
        <td><?php echo 'Employment:'.$row['employment'].'<br>Employer:'.$row['employer'].'<br>Note:'.$row['note'].'<br>Communication:'.$row['communication']; ?></td>
        <td><a href="form.php?emp_id=<?php echo $row['emp_id']?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
        <td><a onclick="return confirm('The row will be deleted')" href="delete.php?emp_id=<?php echo $row['emp_id'].'&photo='.$row['photo']?>"><span class="glyphicon glyphicon-remove error" aria-hidden="true"></span></a></td>
      </tr>
     <?php   } ?>
    </tbody>
  </table>
</div>
  <?php } else {?>
      <div class="container">
      <div class="alert alert-danger">
           <h2> SORRY!!!!!    NO RECORD FOUND</h2> 
  </div>          
</div>



    <?php }?>
</div> 
</body>
</html>