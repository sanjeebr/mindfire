<?php
require_once("config/mysql_connect_db.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function test_input($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}

 $prefix = $first_name = $middle_name = $last_name = $gender = $date_of_birth = $marital = 
    $r_street = $r_city = $r_state = $r_pin = $r_phone = $r_fax = $o_street = $o_city = $o_state =
     $o_pin = $o_phone = $o_fax = $employment = $employer = $note = $communication = $photo = '';


     $first_name_err = $middle_name_err = $last_name_err = $dob_err = $r_street_err = $r_city_err = 
        $r_state_err = $gender_err = $marital_err =  $photo_err = '';


if (isset($_GET['emp_id'])) {

    $emp_id = isset($_GET['emp_id']) ? test_input($_GET['emp_id']) : '';

$sql_query="SELECT  employee.first_name as first_name, employee.middle_name as middle_name, 
 employee.last_name as last_name, employee.date_of_birth as date_of_birth, 
 employee.prefix as prefix, employee.photo as photo, employee.note as note, employee.gender as gender,
 employee.marital_status as marital, employee.communication as communication, employee.employment as employment,
  employee.employer as employer,residence.street as r_street,residence.city as r_city,residence.state as r_state,
  residence.pin_no as r_pin,residence.phone as r_phone,residence.fax as r_fax,office.street as o_street,
  office.city as o_city,office.state as o_state,office.pin_no as o_pin,office.phone as o_phone,office.fax as o_fax
  FROM employee
  LEFT JOIN address as residence on employee.id=residence.employee_id and residence.type='residence'
  LEFT JOIN address as office on employee.id=office.employee_id and office.type='office'";
  
  $result=mysqli_query($conn,$sql_query);

    while($row=mysqli_fetch_assoc($result)){
        $prefix = $row['prefix'];
        $first_name = $row['first_name'];
        $middle_name = $row['middle_name'];
        $last_name = $row['last_name'];
        $gender = $row['gender'];
        $date_of_birth = $row['date_of_birth'];
        $marital = $row['marital'];
        $r_street = $row['r_street'];
        $r_city = $row['r_city'];
        $r_state = $row['r_state'];
        $r_pin = $row['r_pin'];
        $r_phone = $row['r_phone'];
        $r_fax = $row['r_fax'];
        $o_street = $row['o_street'];
        $o_city = $row['o_city'];
        $o_state = $row['o_state'];
        $o_pin = $row['o_pin'];
        $o_phone = $row['o_phone'];
        $o_fax = $row['o_fax'];
        $employment = $row['employment'];
        $employer = $row['employer'];
        $note = $row['note'];
        $communication = $row['communication'];
        $photo = $row['photo'];


  }


}

if (isset($_POST['submit'])||isset($_POST['update'])) { 
    $error=0;
    $prefix = isset($_POST['prefix']) ? test_input($_POST['prefix']) : '';
    $first_name = isset($_POST['first_name']) ? test_input($_POST['first_name']) : '';
    $middle_name = isset($_POST['middle_name']) ? test_input($_POST['middle_name']) : '';
    $last_name = isset($_POST['last_name']) ? test_input($_POST['last_name']) : '';
    $gender = isset($_POST['gender']) ? test_input($_POST['gender']) : '';
    $date_of_birth = isset($_POST['date_of_birth']) ? test_input($_POST['date_of_birth']) : '';
    $marital = isset($_POST['marital']) ? test_input($_POST['marital']) : '';
    $r_street = isset($_POST['r_street']) ? test_input($_POST['r_street']) : '';
    $r_city = isset($_POST['r_city']) ? test_input($_POST['r_city']) : '';
    $r_state = isset($_POST['r_state']) ? test_input($_POST['r_state']) : '';
    $r_pin = isset($_POST['r_pin']) ? test_input($_POST['r_pin']) : '';
    $r_phone = isset($_POST['r_phone']) ? test_input($_POST['r_phone']) : '';
    $r_fax = isset($_POST['r_fax']) ? test_input($_POST['r_fax']) : '';
    $o_street = isset($_POST['o_street']) ? test_input($_POST['o_street']) : '';
    $o_city = isset($_POST['o_city']) ? test_input($_POST['o_city']) : '';
    $o_state = isset($_POST['o_state']) ? test_input($_POST['o_state']) : '';
    $o_pin = isset($_POST['o_pin']) ? test_input($_POST['o_pin']) : '';
    $o_phone = isset($_POST['o_phone']) ? test_input($_POST['o_phone']) : '';
    $o_fax = isset($_POST['o_fax']) ? test_input($_POST['o_fax']) : '';
    $employment = isset($_POST['employment']) ? test_input($_POST['employment']) : '';
    $employer = isset($_POST['employer']) ? test_input($_POST['employer']) : '';
    $note = isset($_POST['note']) ? test_input($_POST['note']) : '';
    $communication = (isset($_POST['communication']) && !empty($_POST['communication']) )
    ? implode(',',$_POST['communication']) : '';





     
    if (empty($_POST["first_name"])) {
    $first_name_err = "First Name is required";
    $error++;
     } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
      $first_name_err = "Only letters and white space allowed"; 
      $error++;
    }
    }
    if (!preg_match("/^[a-zA-Z ]*$/",$middle_name)) {
      $middle_name_err = "Only letters and white space allowed"; 
      $error++;
    }
    if (empty($_POST["last_name"])) {
    $last_name_err = "Last Name is required";
    $error++;
     } else {
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
          $last_name_err = "Only letters and white space allowed"; 
          $error++;
        }
    }

    if (empty($_POST['date_of_birth']))
    {
       $dob_err = 'Date of Birth is required'; 
       $error++;
    }
    else 
    {
        $date = explode('-', $date_of_birth);
        
        if (count($date) !== 3 || ! checkdate($date[1], $date[2], $date[0]))
        {
            $dob_err = 'Date of Birth is invalid ';
            
        }
    }
    
    if(empty($_POST["gender"]))
    {
       $gender_err = "Gender is required"; 
       $error++;
    }
    if(empty($_POST["marital"]))
    {
       $marital_err = "Marital Status is required"; 
       $error++;
    }
    if(empty($_POST["r_street"]))
    {
       $r_street_err = "Street is required"; 
       $error++;
    }
    if(empty($_POST["r_city"]))
    {
       $r_city_err = "City is required"; 
       $error++;
    }
    if(empty($_POST["r_state"]))
    {
       $r_state_err = "State is required"; 
       $error++;
    }
if (0===$error) {
     //for new form submit
    if (isset($_POST['submit'])) {

        $sql_query="INSERT INTO employee
                    (first_name, middle_name, last_name, date_of_birth, prefix,
                       photo, note, gender, marital_status,communication, employment, employer) 
                    VALUES ('$first_name', '$middle_name', '$last_name', '$date_of_birth', '$prefix', '$photo',
                       '$note', '$gender','$marital','$communication', '$employment','$employer')";
        $result = mysqli_query($conn,$sql_query);
        $employee_id = mysqli_insert_id($conn);
    
        if (FALSE==$result) {

          header("Location: error.php");

          }

        $sql_query = "INSERT INTO `address`
                   (`employee_id`, `type`, `phone`, `fax`, `street`, `pin_no`,`city`, `state`) 
                VALUES ($employee_id,'residence','$r_phone','$r_fax','$r_street','$r_pin',
                   '$r_city','$r_state'),
                   ($employee_id,'office','$o_phone','$o_fax','$o_street','$o_pin','$o_city'
                    ,'$o_state')";
     
         $result = mysqli_query($conn,$sql_query);

        if (FALSE==$result) {

          header("Location: error.php");

          }

        header("Location: output.php");
    
    }
    //for update form
    else if (isset($_POST['update'])&&isset($_GET['emp_id'])) {
    
      $sql_query = "UPDATE `employee` 
                    SET `first_name`='$first_name',`middle_name`='$middle_name',`last_name`='$last_name',
                    `date_of_birth`= '$date_of_birth',`prefix`='$prefix',`photo`='$photo',
                    `note`='$note',`gender`='$gender',`marital_status`='$marital',`communication`='$communication',
                    `employment`='$employment',`employer`='$employer' 
                    WHERE id = $emp_id";
    
       echo "$sql_query";
        $result = mysqli_query($conn,$sql_query);

      $sql_query = "UPDATE `address` 
                    SET `phone`= '$o_phone',`fax`='$o_fax',`street`= '$o_street',`pin_no`= '$o_pin',
                    `city`= '$o_city',`state` = '$o_state' 
                     WHERE employee_id = $emp_id AND type = 'office'";
        echo "$sql_query";
       $result = mysqli_query($conn,$sql_query);
 
       $sql_query = "UPDATE `address` 
                    SET `phone`= '$r_phone',`fax`='$r_fax',`street`= '$r_street',`pin_no`= '$r_pin',
                    `city`= '$r_city',`state` = '$r_state' 
                     WHERE employee_id = $emp_id AND type = 'residence'";
        echo "$sql_query";
        $result = mysqli_query($conn,$sql_query);           

        header("Location: output.php");
    

    }
     
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Registration</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/form.css"  />
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
        <li class="active"><a href="">Registration</a></li>
        <li ><a href="output.php">Employee Details</a></li>
      </ul>
    </div>
  </div>
</nav>
        <div class="container">
            <h1>Registration Form</h1>
            <br>
        <form role="form" id="empform" method="post" action="">
        <div class="well"><h3>Personal Info:</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                     <label for="prefix"><span class="error">*</span>Prefix:</label>
                        <select name="prefix" id="prefix" class="form-control">
                         <option value="Mr">Mr</option>
                         <option value="Ms" <?php if($prefix=='Ms'){ echo "selected"; } ?>>Ms</option>
                         <option value="Mrs" <?php if($prefix=='Mrs'){ echo "selected"; } ?>>Mrs</option>
                     </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label for="fname"><span class="error">*</span>First Name:</label>
                        <input type="text" class="form-control" id="fname" name="first_name" placeholder="First Name" <?php  echo "value='$first_name'";?>>
                        <br><span class="error"><?php echo $first_name_err;?></span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label for="mname">Middle Name:</label>
                        <input type="text" class="form-control" id="mname" name="middle_name" placeholder="Middle Name" <?php  echo "value='$middle_name'";?>>
                        <br><span class="error"><?php echo $middle_name_err;?></span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">      
                        <label for="lname"><span class="error">*</span>Last Name:</label>
                        <input type="text" class="form-control" id="lname" name="last_name" placeholder="Last Name" <?php  echo "value='$last_name'";?>>
                        <br><span class="error"><?php echo $last_name_err; ?></span>
                    </div>
                </div>
            </div>
           <div class="row">
               <div class="col-lg-3 col-md-3">
                   <div class="form-group">
                       <label for="dob"><span class="error">*</span>Gender:</label>
                       <div class="radio">
                           <label class="radio-inline">
                               <input type="radio" id="male" name="gender" value="Male" checked>Male
                           </label>
                           <label class="radio-inline">
                               <input type="radio" id="female" name="gender" value="Female" <?php if($gender=='Female'){ echo "checked"; } ?>>Female
                           </label>
                       </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-3">
                  <div class="form-group">
                      <label for="dob"><span class="error">*</span>Date of Birth:</label>
                      <div class="date">
                      <input type="date" name="date_of_birth" class="form-control" id="dob" <?php  echo "value='$date_of_birth'";?> >
                      <br><span class="error"><?php echo $dob_err;?></span>
                      </div>
                 </div>
              </div>
              <div class="col-lg-3 col-md-3">
                  <div class="form-group">
                     <label for="marital"><span class="error">*</span>Marital Status:</label>
                     <div class="radio">
                           <label class="radio-inline">
                               <input type="radio" id="single" name="marital" value="Single" checked>Single
                           </label>
                           <label class="radio-inline">
                               <input type="radio" id="married" name="marital" value="Married" <?php if($marital=='Married'){ echo "checked"; } ?>>Married
                           </label>
                       </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-3">
                  <div class="form-group">
                      <label for="photo">Upload Photo:</label>
                      <input type="file" class="form-control" id="photo" name="photo" accept="image/*" <?php  echo "value='$photo'";?>>
                  </div>
              </div>
         </div>
         </div>
         <div class="row">
             <div class="col-lg-6 col-md-6">
                 <div class="form-group">
                     <div class="well"><h3>Residence Address:</h3>
                     <label for="r_street"><span class="error">*</span>Street Name:</label><span class="error"><?php echo $r_street_err?></span>
                     <input type="text" class="form-control" id="r_street" name="r_street" placeholder="Street name..."  <?php  echo "value='$r_street'";?>>
                     <label for="r_city"><span class="error">*</span>City:</label><span class="error"><?php echo $r_city_err?></span>
                     <input type="text" class="form-control" id="r_city" name="r_city" placeholder="City..." <?php  echo "value='$r_city'";?>>
                     <label for="r_state"><span class="error">*</span>State:</label><span class="error"><?php echo $r_state_err?></span>
                     <select  id="r_state" class="form-control" name="r_state">
                         <option value="">Select State</option>
                         <option value="Andaman and Nicobar Islands" <?php if($r_state=='Andaman and Nicobar Islands'){ echo "selected"; } ?>>Andaman and Nicobar Islands</option>
                         <option value="Andhra Pradesh" <?php if($r_state=='Andhra Pradesh'){ echo "selected"; } ?>>Andhra Pradesh</option>
                         <option value="Arunachal Pradesh" <?php if($r_state=='Arunachal Pradesh'){ echo "selected"; } ?>>Arunachal Pradesh</option>
                         <option value="Assam" <?php if($r_state=='Assam'){ echo "selected"; } ?>>Assam</option>
                         <option value="Bihar" <?php if($r_state=='Bihar'){ echo "selected"; } ?>>Bihar</option>
                         <option value="Chandigarh" <?php if($r_state=='Chandigarh'){ echo "selected"; } ?>>Chandigarh</option>
                         <option value="Chhattisgarh" <?php if($r_state=='Chhattisgarh'){ echo "selected"; } ?>>Chhattisgarh</option>
                         <option value="Dadra and Nagar Haveli" <?php if($r_state=='Dadra and Nagar Haveli'){ echo "selected"; } ?>>Dadra and Nagar Haveli</option>
                         <option value="Daman and Diu" <?php if($r_state=='Daman and Diu'){ echo "selected"; } ?>>Daman and Diu</option>
                         <option value="Delhi" <?php if($r_state=='Delhi'){ echo "selected"; } ?>>Delhi</option>
                         <option value="Goa" <?php if($r_state=='Goa'){ echo "selected"; } ?>>Goa</option>
                         <option value="Gujarat" <?php if($r_state=='Gujarat'){ echo "selected"; } ?>>Gujarat</option>
                         <option value="Haryana" <?php if($r_state=='Haryana'){ echo "selected"; } ?>>Haryana</option>
                         <option value="Himachal Pradesh" <?php if($r_state=='Himachal Pradesh'){ echo "selected"; } ?>>Himachal Pradesh</option>
                         <option value="Jammu and Kashmir" <?php if($r_state=='Jammu and Kashmir'){ echo "selected"; } ?>>Jammu and Kashmir</option>
                         <option value="Jharkhand" <?php if($r_state=='Jharkhand'){ echo "selected"; } ?>>Jharkhand</option>                         
                         <option value="Karnataka" <?php if($r_state=='Karnataka'){ echo "selected"; } ?>>Karnataka</option>
                         <option value="Kerala" <?php if($r_state=='Kerala'){ echo "selected"; } ?>>Kerala</option>
                         <option value="Lakshadweep" <?php if($r_state=='Lakshadweep'){ echo "selected"; } ?>>Lakshadweep</option>
                         <option value="Madhya Pradesh" <?php if($r_state=='Madhya Pradesh'){ echo "selected"; } ?>>Madhya Pradesh</option>
                         <option value="Maharashtra" <?php if($r_state=='Maharashtra'){ echo "selected"; } ?>>Maharashtra</option>
                         <option value="Manipur" <?php if($r_state=='Manipur'){ echo "selected"; } ?>>Manipur</option>
                         <option value="Meghalaya" <?php if($r_state=='Meghalaya'){ echo "selected"; } ?>>Meghalaya</option>
                         <option value="Mizoram" <?php if($r_state=='Mizoram'){ echo "selected"; } ?>>Mizoram</option>
                         <option value="Nagaland" <?php if($r_state=='Nagaland'){ echo "selected"; } ?>>Nagaland</option>
                         <option value="Orissa" <?php if($r_state=='Orissa'){ echo "selected"; } ?>>Orissa</option>
                         <option value="Pondicherry" <?php if($r_state=='Pondicherry'){ echo "selected"; } ?>>Pondicherry</option>
                         <option value="Punjab" <?php if($r_state=='Punjab'){ echo "selected"; } ?>>Punjab</option>
                         <option value="Rajasthan" <?php if($r_state=='Rajasthan'){ echo "selected"; } ?>>Rajasthan</option>
                         <option value="Sikkim" <?php if($r_state=='Sikkim'){ echo "selected"; } ?>>Sikkim</option>
                         <option value="Tamil Nadu" <?php if($r_state=='Tamil Nadu'){ echo "selected"; } ?>>Tamil Nadu</option>
                         <option value="Tripura" <?php if($r_state=='Tripura'){ echo "selected"; } ?>>Tripura</option>
                         <option value="Uttaranchal" <?php if($r_state=='Uttaranchal'){ echo "selected"; } ?>>Uttaranchal</option>
                         <option value="Uttar Pradesh" <?php if($r_state=='Uttar Pradesh'){ echo "selected"; } ?>>Uttar Pradesh</option>
                         <option value="West Bengal" <?php if($r_state=='West Bengal'){ echo "selected"; } ?>>West Bengal</option>
                     </select>
                     <label for="r_pin"><span class="error">*</span>Pin no:</label><span class="error"><?php ?></span>
                     <input type="text" class="form-control" id="r_pin" placeholder="Pin No" name="r_pin" <?php  echo "value='$r_pin'";?>>
                     <label for="r_phone"><span class="error">*</span>Phone No:</label><span class="error"><?php ?></span>
                     <input type="text" class="form-control" id="r_phone" placeholder="eg:+919990001234" name="r_phone" <?php  echo "value='$r_phone'";?>>
                     <label for="r_fax">Fax:</label>
                     <input type="text" class="form-control" id="r_fax" placeholder="Fax Number" name="r_fax" <?php  echo "value='$r_fax'";?>>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 col-md-6">
              <div class="form-group">
                  <div class="well"><h3>Office Address:</h3>
                  <label for="o_street">Street Name:</label>
                  <input type="text" class="form-control" id="o_street" name="o_street" placeholder="Street name..." <?php  echo "value='$o_street'";?>>
                  <label for="o_city">City:</label>
                  <input type="text" class="form-control" id="o_city" name="o_city" placeholder="City.." <?php  echo "value='$o_city'";?>>
                  <label for="o_state">State:</label>
                  <select  id="o_state" class="form-control" name="o_state">
                       <option value="">Select State</option>
                       <option value="Andaman and Nicobar Islands" <?php if($o_state=='Andaman and Nicobar Islands'){ echo "selected"; } ?>>Andaman and Nicobar Islands</option>
                       <option value="Andhra Pradesh" <?php if($o_state=='Andhra Pradesh'){ echo "selected"; } ?>>Andhra Pradesh</option>
                       <option value="Arunachal Pradesh" <?php if($o_state=='Arunachal Pradesh'){ echo "selected"; } ?>>Arunachal Pradesh</option>
                       <option value="Assam" <?php if($o_state=='Assam'){ echo "selected"; } ?>>Assam</option>
                       <option value="Bihar" <?php if($o_state=='Bihar'){ echo "selected"; } ?>>Bihar</option>
                       <option value="Chandigarh" <?php if($o_state=='Chandigarh'){ echo "selected"; } ?>>Chandigarh</option>
                       <option value="Chhattisgarh" <?php if($o_state=='Chhattisgarh'){ echo "selected"; } ?>>Chhattisgarh</option>
                       <option value="Dadra and Nagar Haveli" <?php if($o_state=='Dadra and Nagar Haveli'){ echo "selected"; } ?>>Dadra and Nagar Haveli</option>
                       <option value="Daman and Diu" <?php if($o_state=='Daman and Diu'){ echo "selected"; } ?>>Daman and Diu</option>
                       <option value="Delhi" <?php if($o_state=='Delhi'){ echo "selected"; } ?>>Delhi</option>
                       <option value="Goa" <?php if($o_state=='Goa'){ echo "selected"; } ?>>Goa</option>
                       <option value="Gujarat" <?php if($o_state=='Gujarat'){ echo "selected"; } ?>>Gujarat</option>
                       <option value="Haryana" <?php if($o_state=='Haryana'){ echo "selected"; } ?>>Haryana</option>
                       <option value="Himachal Pradesh" <?php if($o_state=='Himachal Pradesh'){ echo "selected"; } ?>>Himachal Pradesh</option>
                       <option value="Jammu and Kashmir" <?php if($o_state=='Jammu and Kashmir'){ echo "selected"; } ?>>Jammu and Kashmir</option>
                       <option value="Jharkhand" <?php if($o_state=='Jharkhand'){ echo "selected"; } ?>>Jharkhand</option>
                       <option value="Karnataka" <?php if($o_state=='Karnataka'){ echo "selected"; } ?>>Karnataka</option>
                       <option value="Kerala" <?php if($o_state=='Kerala'){ echo "selected"; } ?>>Kerala</option>
                       <option value="Lakshadweep" <?php if($o_state=='Lakshadweep'){ echo "selected"; } ?>>Lakshadweep</option>
                       <option value="Madhya Pradesh" <?php if($o_state=='Madhya Pradesh'){ echo "selected"; } ?>>Madhya Pradesh</option>
                       <option value="Maharashtra" <?php if($o_state=='Maharashtra'){ echo "selected"; } ?>>Maharashtra</option>
                       <option value="Manipur" <?php if($o_state=='Manipur'){ echo "selected"; } ?>>Manipur</option>
                       <option value="Meghalaya" <?php if($o_state=='Meghalaya'){ echo "selected"; } ?>>Meghalaya</option>
                       <option value="Mizoram" <?php if($o_state=='Mizoram'){ echo "selected"; } ?>>Mizoram</option>
                       <option value="Nagaland" <?php if($o_state=='Nagaland'){ echo "selected"; } ?>>Nagaland</option>
                       <option value="Orissa" <?php if($o_state=='Orissa'){ echo "selected"; } ?>>Orissa</option>
                       <option value="Pondicherry" <?php if($o_state=='Pondicherry'){ echo "selected"; } ?>>Pondicherry</option>
                       <option value="Punjab" <?php if($o_state=='Punjab'){ echo "selected"; } ?>>Punjab</option>
                       <option value="Rajasthan" <?php if($o_state=='Rajasthan'){ echo "selected"; } ?>>Rajasthan</option>
                       <option value="Sikkim" <?php if($o_state=='Sikkim'){ echo "selected"; } ?>>Sikkim</option>
                       <option value="Tamil Nadu" <?php if($o_state=='Tamil Nadu'){ echo "selected"; } ?>>Tamil Nadu</option>
                       <option value="Tripura" <?php if($o_state=='Tripura'){ echo "selected"; } ?>>Tripura</option>
                       <option value="Uttaranchal" <?php if($o_state=='Uttaranchal'){ echo "selected"; } ?>>Uttaranchal</option>
                       <option value="Uttar Pradesh" <?php if($o_state=='Uttar Pradesh'){ echo "selected"; } ?>>Uttar Pradesh</option>
                       <option value="West Bengal" <?php if($o_state=='West Bengal'){ echo "selected"; } ?>>West Bengal</option>
                  </select>
                  <label for="o_pin">Pin no:</label>
                  <input type="text" class="form-control" id="o_pin" name="o_pin" placeholder="Pin No" <?php  echo "value='$o_pin'";?>>
                  <label for="o_phone">Phone No:</label>
                  <input type="text" class="form-control" id="o_phone" name="o_phone" placeholder="eg:+919990001234" <?php  echo "value='$o_phone'";?> >
                  <label for="o_fax">Fax:</label>
                  <input type="text" class="form-control" id="o_fax" name="o_fax" placeholder="Fax Number" <?php  echo "value='$o_fax'";?>>
              </div>
           </div>
        </div>
    </div>
    <div class="well"><h3>Other Info:</h3>
        <div class="row">
              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label for="employment">Employment:</label>
                      <input type="text" class="form-control" id="employment" name="employment" placeholder="Employment" <?php  echo "value='$employment'";?>>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label for="employer">Employer:</label>
                      <input type="text" class="form-control" id="employer" name="employer" placeholder="Employer" <?php  echo "value='$employer'";?>>
                 </div>
              </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label for="extra">Extra Note:</label>
                <textarea class="form-control" id="extra" name="note" placeholder="Extra Note.."><?php  echo "$note";?></textarea>
              </div>
            </div>
        </div>
        <div class="row">
           <div class="form-group">
           <div class="col-lg-4 col-md-4">
                <label>Preferred communication medium:</label>
            </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6"> 
                    <div class="checkbox-inline" id="Mail">
                       <label><input type="checkbox" name="communication[]" value="Mail" <?php if(strpos($communication, 'Mail')!==FALSE){echo "checked";}?>>Mail</label>

                    </div>
                 </div>
                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                    <div class="checkbox-inline" id="Message">
                       <label><input type="checkbox" name="communication[]" value="Message" <?php if(strpos($communication, 'Message')!==FALSE){echo "checked";}?>>Message</label>
                    </div>
                    </div>
                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">   
                    <div class="checkbox-inline" id="phone">
                       <label><input type="checkbox" name="communication[]" value="Phone Call" <?php if(strpos($communication, 'Phone Call')!==FALSE){echo "checked";}?>>Phone Call</label>
                    </div>
                 </div>  
                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                    <div class="checkbox-inline" id="any">
                       <label><input type="checkbox" name="communication[]" value="Any" <?php if(strpos($communication, 'Any')!==FALSE){echo "checked";}?>>Any</label>
                    </div>
                </div>
            </div>
      </div>
      </div>
      <div class="row form-group text-center">
                <?php if(isset($_GET['emp_id'])) {?>
                <a class="btn btn-danger btn-lg" href="output.php" >Cancel</a>&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-warning btn-lg" name="update">Update</button>

                <?php }else{ ?>
                <button class="btn btn-danger btn-lg" type="reset" >Reset</button>&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-warning btn-lg" name="submit">Submit</button>
                <?php } ?>
      </div>
      </form>
    </div> 
    <div class="row  text-center">
         <div class="page-footer">Copyright <span class="glyphicon glyphicon-copyright-mark">2016 sanjeeb@mindfire</span></div> 
   </div>
   </div> 
</body>
</html>