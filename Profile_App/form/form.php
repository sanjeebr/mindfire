<?php
include_once("php/mysql_connect_db.php");
if (isset($_POST['submit'])) { 

    $prefix = isset($_POST['prefix'])?$_POST['prefix'] :'';
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] :'';
    $middle_name = isset($_POST['middle_name']) ? $_POST['middle_name'] :'';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] :'';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $date_of_birth = isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] :'';
    $marital = isset($_POST['marital']) ? $_POST['marital'] :'';
    $r_street = isset($_POST['r_street']) ?$_POST['r_street'] :'';
    $r_city = isset($_POST['r_city']) ? $_POST['r_city'] :'';
    $r_state = isset($_POST['r_state']) ? $_POST['r_state'] :'';
    $r_pin = isset($_POST['r_pin']) ? $_POST['r_pin'] :'';
    $r_phone = isset($_POST['r_phone']) ? $_POST['r_phone'] :'';
    $r_fax = isset($_POST['r_fax']) ? $_POST['r_fax'] : '';
    $o_street = isset($_POST['o_street']) ? $_POST['o_street'] :'';
    $o_city = isset($_POST['o_city']) ? $_POST['o_city'] :'';
    $o_state = isset($_POST['o_state']) ? $_POST['o_state'] :'';
    $o_pin = isset($_POST['o_pin']) ? $_POST['o_pin'] :'';
    $o_phone = isset($_POST['o_phone']) ? $_POST['o_phone'] :'';
    $o_fax = isset($_POST['o_fax']) ? $_POST['o_fax'] :'';
    $employment = isset($_POST['employment']) ? $_POST['employment'] :'';
    $employer = isset($_POST['employer']) ? $_POST['employer'] :'';
    $note = isset($_POST['note']) ? $_POST['note']:'';
    $communication = (isset($_POST['communication']) && !empty($_POST['communication']) )? implode(',',$_POST['communication']):'';
    $photo = isset($_POST['photo'])?$_POST['photo']:'';
     
    $sql_query="INSERT INTO employee(first_name, middle_name, last_name, date_of_birth, prefix, photo, note, gender, marital_status,communication_id, employment, employer) VALUES ('$first_name', '$middle_name', '$last_name', $date_of_birth, '$prefix', '$photo', '$note', '$gender','$marital','$communication', '$employment','$employer')";


    mysqli_query($conn,$sql_query);



    $employee_id = mysqli_insert_id($conn);
    
    $sql_query="INSERT INTO `address`(`employee_id`, `type`, `phone`, `fax`, `street`, `pin_no`, `city`, `state_id`) VALUES ($employee_id,'residence','$r_phone','$r_fax','$r_street','$r_pin','$r_city',$r_state),($employee_id,'office','$o_phone','$o_fax','$o_street','$o_pin','$o_city',$o_state)";
     
    mysqli_query($conn,$sql_query);
    header("Location: output.php");
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
    <div class="container-fluid">
        <div class="container">
            <h1>Registration Form</h1>
            <br>
        <form role="form" id="empform" method="post" action="">
        <div class="well"><h3>Personal Info:</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                     <label for="prefix">Prefix:</label>
                        <select name="prefix" id="prefix" class="form-control">
                         <option value="Mr">Mr</option>
                         <option value="Ms">Ms</option>
                         <option value="Mrs">Mrs</option>
                     </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" class="form-control" id="fname" name="first_name" placeholder="First Name">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label for="mname">Middle Name:</label>
                        <input type="text" class="form-control" id="mname" name="middle_name" placeholder="Middle Name">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">      
                        <label for="lname">Last Name:</label>
                        <input type="text" class="form-control" id="lname" name="last_name" placeholder="Last Name">
                    </div>
                </div>
            </div>
           <div class="row">
               <div class="col-lg-3 col-md-3">
                   <div class="form-group">
                       <label for="dob">Gender:</label>
                       <div class="radio">
                           <label class="radio-inline">
                               <input type="radio" id="male" name="gender" value="Male" checked>Male
                           </label>
                           <label class="radio-inline">
                               <input type="radio" id="female" name="gender" value="Female">Female
                           </label>
                       </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-3">
                  <div class="form-group">
                      <label for="dob">Date of Birth:</label>
                      <div class="date">
                      <input type="date" name="date_of_birth" class="form-control" id="dob" >
                      </div>
                 </div>
              </div>
              <div class="col-lg-3 col-md-3">
                  <div class="form-group">
                     <label for="marital">Marital Status:</label>
                     <div class="radio">
                           <label class="radio-inline">
                               <input type="radio" id="single" name="marital" value="Single" checked>Single
                           </label>
                           <label class="radio-inline">
                               <input type="radio" id="married" name="marital" value="Married">Married
                           </label>
                       </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-3">
                  <div class="form-group">
                      <label for="photo">Upload Photo:</label>
                      <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                  </div>
              </div>
         </div>
         </div>
         <div class="row">
             <div class="col-lg-6 col-md-6">
                 <div class="form-group">
                     <div class="well"><h3>Residence Address:</h3>
                     <label for="r_street">Street Name:</label>
                     <input type="text" class="form-control" id="r_street" name="r_street" placeholder="Street name..." >
                     <label for="r_city">City:</label>
                     <input type="text" class="form-control" id="r_city" name="r_city" placeholder="City.." >
                     <label for="r_state">State:</label>
                     <select  id="r_state" class="form-control" name="r_state">
                         <option value="">Select State</option>
                         <option value="1">Andaman and Nicobar Islands</option>
                         <option value="Andhra Pradesh">Andhra Pradesh</option>
                         <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                         <option value="Assam">Assam</option>
                         <option value="Bihar">Bihar</option>
                         <option value="Chandigarh">Chandigarh</option>
                         <option value="Chhattisgarh">Chhattisgarh</option>
                         <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                         <option value="Daman and Diu">Daman and Diu</option>
                         <option value="Delhi">Delhi</option>
                         <option value="Goa">Goa</option>
                         <option value="Gujarat">Gujarat</option>
                         <option value="Haryana">Haryana</option>
                         <option value="Himachal Pradesh">Himachal Pradesh</option>
                         <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                         <option value="Jharkhand">Jharkhand</option>                         
                         <option value="Karnataka">Karnataka</option>
                         <option value="Kerala">Kerala</option>
                         <option value="Lakshadweep">Lakshadweep</option>
                         <option value="Madhya Pradesh">Madhya Pradesh</option>
                         <option value="Maharashtra">Maharashtra</option>
                         <option value="Manipur">Manipur</option>
                         <option value="Meghalaya">Meghalaya</option>
                         <option value="Mizoram">Mizoram</option>
                         <option value="Nagaland">Nagaland</option>
                         <option value="Orissa">Orissa</option>
                         <option value="Pondicherry">Pondicherry</option>
                         <option value="Punjab">Punjab</option>
                         <option value="Rajasthan">Rajasthan</option>
                         <option value="Sikkim">Sikkim</option>
                         <option value="Tamil Nadu">Tamil Nadu</option>
                         <option value="Tripura">Tripura</option>
                         <option value="Uttaranchal">Uttaranchal</option>
                         <option value="Uttar Pradesh">Uttar Pradesh</option>
                         <option value="West Bengal">West Bengal</option>
                     </select>
                     <label for="r_pin">Pin no:</label>
                     <input type="text" class="form-control" id="r_pin" placeholder="Pin No" name="r_pin" >
                     <label for="r_phone">Phone No:</label>
                     <input type="text" class="form-control" id="r_phone" placeholder="eg:+919990001234" name="r_phone">
                     <label for="r_fax">Fax:</label>
                     <input type="text" class="form-control" id="r_fax" placeholder="Fax Number" name="r_fax">
                  </div>
              </div>
          </div>
          <div class="col-lg-6 col-md-6">
              <div class="form-group">
                  <div class="well"><h3>Office Address:</h3>
                  <label for="o_street">Street Name:</label>
                  <input type="text" class="form-control" id="o_street" name="o_street" placeholder="Street name..." >
                  <label for="o_city">City:</label>
                  <input type="text" class="form-control" id="o_city" name="o_city" placeholder="City.." >
                  <label for="o_state">State:</label>
                  <select  id="o_state" class="form-control" name="o_state">
                       <option value="">Select State</option>
                       <option value="1">Andaman and Nicobar Islands</option>
                       <option value="2">Andhra Pradesh</option>
                       <option value="3">Arunachal Pradesh</option>
                       <option value="4">Assam</option>
                       <option value="5">Bihar</option>
                       <option value="6">Chandigarh</option>
                       <option value="Chhattisgarh">Chhattisgarh</option>
                       <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                       <option value="Daman and Diu">Daman and Diu</option>
                       <option value="Delhi">Delhi</option>
                       <option value="Goa">Goa</option>
                       <option value="Gujarat">Gujarat</option>
                       <option value="Haryana">Haryana</option>
                       <option value="Himachal Pradesh">Himachal Pradesh</option>
                       <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                       <option value="Jharkhand">Jharkhand</option>
                       <option value="Karnataka">Karnataka</option>
                       <option value="Kerala">Kerala</option>
                       <option value="Lakshadweep">Lakshadweep</option>
                       <option value="Madhya Pradesh">Madhya Pradesh</option>
                       <option value="Maharashtra">Maharashtra</option>
                       <option value="Manipur">Manipur</option>
                       <option value="Meghalaya">Meghalaya</option>
                       <option value="Mizoram">Mizoram</option>
                       <option value="Nagaland">Nagaland</option>
                       <option value="Orissa">Orissa</option>
                       <option value="Pondicherry">Pondicherry</option>
                       <option value="Punjab">Punjab</option>
                       <option value="Rajasthan">Rajasthan</option>
                       <option value="Sikkim">Sikkim</option>
                       <option value="Tamil Nadu">Tamil Nadu</option>
                       <option value="Tripura">Tripura</option>
                       <option value="Uttaranchal">Uttaranchal</option>
                       <option value="Uttar Pradesh">Uttar Pradesh</option>
                       <option value="West Bengal">West Bengal</option>
                  </select>
                  <label for="o_pin">Pin no:</label>
                  <input type="text" class="form-control" id="o_pin" name="o_pin" placeholder="Pin No" >
                  <label for="o_phone">Phone No:</label>
                  <input type="text" class="form-control" id="o_phone" name="o_phone" placeholder="eg:+919990001234" >
                  <label for="o_fax">Fax:</label>
                  <input type="text" class="form-control" id="o_fax" name="o_fax" placeholder="Fax Number" >
              </div>
           </div>
        </div>
    </div>
    <div class="well"><h3>Other Info:</h3>
        <div class="row">
              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label for="employment">Employment:</label>
                      <input type="text" class="form-control" id="employment" name="employment" placeholder="Employment">
                  </div>
              </div>
              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label for="employer">Employer:</label>
                      <input type="text" class="form-control" id="employer" name="employer" placeholder="Employer">
                 </div>
              </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label for="extra">Extra Note:</label>
                <textarea class="form-control" id="extra" name="note" placeholder="Extra Note.."></textarea>
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
                       <label><input type="checkbox" name="communication[]" value="Mail">Mail</label>

                    </div>
                 </div>
                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                    <div class="checkbox-inline" id="Message">
                       <label><input type="checkbox" name="communication[]" value="Message">Message</label>
                    </div>
                    </div>
                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">   
                    <div class="checkbox-inline" id="phone">
                       <label><input type="checkbox" name="communication[]" value="Phone Call">Phone Call</label>
                    </div>
                 </div>  
                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                    <div class="checkbox-inline" id="any">
                       <label><input type="checkbox" name="communication[]" value="Any">Any</label>
                    </div>
                </div>
            </div>
      </div>
      </div>
      <div class="row form-group text-center">
                <button class="btn btn-danger btn-lg" type="reset" >Reset</button>&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-warning btn-lg" name="submit">Submit</button>
      </div>
      </form>
    </div> 
    <div class="row  text-center">
         <div class="page-footer">Copyright <span class="glyphicon glyphicon-copyright-mark">2016 sanjeeb@mindfire</span></div> 
   </div>
   </div> 
</body>
</html>