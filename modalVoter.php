<div id="modal-primary" class="modal fade">
<div class="modal-dialog">
   <div class="modal-content">
        <div class="modal-header bg-primary text-center">
             <h4 class="modal-title" style="color:#fff;">Voter Account</h4>
        </div>
        <div class="modal-body">

             <div class="row">
                <div class="col-md-12">

                    <form  method="POST">
                    <div class="row">
                       <div class="col-md-12">
                            <fieldset class="form-group">
                        <label for="fname">Student Number</label>
                        <input type="text" class="form-control" id="stud_id" name="stud_id" placeholder="Student Number" required="required">
                        </fieldset>
                       </div>  
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                        <fieldset class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="emp_fname" name="emp_fname" placeholder="Enter First Name" required="required">
                        </fieldset>
                        </div>
                        <div class="col-md-6">
                        <fieldset class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="emp_lname" name="emp_lname" placeholder="Enter Last Name" required="">
                    </fieldset>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                    <fieldset class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" placeholder="Enter Birthday" required="">
                    </fieldset>
                    </div>
                    <div class="col-md-6">
                    <fieldset class="form-group">
                        <label for="gender">Gender</label>
                       <select  class="form-control" name="emp_sex">
                            <option value="0">Select Gender</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </fieldset>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <fieldset class="form-group">
                        <label for="address">Physical Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Physical Address" required="">
                    </fieldset>
                    </div>
                    <div class="col-md-6">
                    <fieldset class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required="">
                    </fieldset>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <fieldset class="form-group">
                        <label for="programme">Programme</label>
                          <select  class="form-control" name="programme">
                            <option value="0">Select Programme</option>
                            <option value="BCOM">Commerce</option>
                            <option value="Finc">Finance</option>
                            <option value="PG">Peace and Govenance</option>
                            <option value="SWC">Social Work</option>
                            <option value="CS">Computer Science</option>
                            <option value="AS">Animal Science</option>
                        </select>
                    </fieldset>
                    </div>
                    <div class="col-md-6">
                    <fieldset class="form-group">
                       <label for="telephone">Phone Number</label>
                           <input type="telephone" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required="">
                       </fieldset>
                    </div>
                    </div>


                    <button type="submit" class="btn btn-success btn-block" id="btn-cand" name="btnvoter"> Create Account <i class="fa fa-sign-in-alt"></i></button>
                </form>
                </div>
             </div>
        </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
           </div>
      </div>
      
 </div>

 <?php

if (isset($_POST['btnvoter'])) {

$stud_id= htmlentities(trim($_POST['stud_id']));
$firstname= htmlentities(trim($_POST['emp_fname']));
$lastname= htmlentities(trim($_POST['emp_lname']));
$dob= htmlentities(trim($_POST['birth_date']));
$gender= htmlentities(trim($_POST['emp_sex']));
$address= htmlentities(trim($_POST['address']));
$email= htmlentities(trim($_POST['email']));
$programme= htmlentities(trim($_POST['programme']));
$phone= htmlentities(trim($_POST['phone']));



// validate and filter
if (empty($stud_id)) {
    $_SESSION['err_message'] = "Student Number is required";
    echo "<script>alert('Student Number is required')</script>";
}
else if(empty($firstname)) {
    $_SESSION['err_message'] = "Student Name is required";
    echo "<script>alert('Please voter name is required')</script>";
}
else if(empty($lastname)) {
    $_SESSION['err_message'] = "Surname is required";
    echo "<script>alert('Please voter surname is required')</script>";
}
else if(empty($dob)) {
    $_SESSION['err_message'] = "Please select voter DOB";
    echo "<script>alert('Please select DOB')</script>";
}
else if(empty($gender)) {
    $_SESSION['err_message'] = "Please select gender";
    echo "<script>alert('Please select gender')</script>";
}
else if(empty($address)) {
    $_SESSION['err_message'] = "Please enter voter address";
    echo "<script>alert('Please enter voter address')</script>";
}
else if(empty($email)) {
    $_SESSION['err_message'] = "Please enter email address";
    echo "<script>alert('Please enter email address')</script>";
}
else if(empty($programme)) {
    $_SESSION['err_message'] = "Please select voter programme";
    echo "<script>alert('Please select voter programme')</script>";
}
else if(empty($phone)) {
    $_SESSION['err_message'] = "Please provide voter phone number";
    echo "<script>alert('Please provide voter phone number')</script>";
}



else{
    $password = md5("123456");

    $Voters = Voters::CreateVoter($stud_id,$firstname,$lastname,$password,$email,$gender,$dob,$address,$phone,$programme);
    if ($Voters === true) {

        $_SESSION['success_message'] = "Voter's Account has been created successfully";
         echo "<script>alert('Voter's Account has been created successfully')</script>";
       

    }
    else{
        $_SESSION['err_message'] = "Something went wrong please try again";
    }
}
}

?>