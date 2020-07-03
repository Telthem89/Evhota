<?php
$candidate = new Candidate();
if (isset($_POST['btnsubmit'])) {
$firstname= htmlentities(trim($_POST['firstname']));
$lastname= htmlentities(trim($_POST['lastname']));
$email= htmlentities(trim($_POST['email']));
$programme= htmlentities(trim($_POST['programme']));
$dob= htmlentities(trim($_POST['dob']));
$address= htmlentities(trim($_POST['address']));
$phone= htmlentities(trim($_POST['phone']));
$gender= htmlentities(trim($_POST['gender']));
$roleID = htmlentities(trim($_POST['roleID']));

$image =$_FILES['imageurl']['name'];
$arrynamr = explode('.', $image);
$exploext = array_pop( $arrynamr);
$time = time().rand(1000,9999).".".$exploext;
$imageurl = "./img/cntpics/".$time;

// validate and filter
if (empty($firstname)) {
	$_SESSION['err_message'] = "First Name is required";
}
else if(empty($lastname)) {
	$_SESSION['err_message'] = "Surname is required";
}
else if(empty($email)) {
	$_SESSION['err_message'] = "Email is required";
}
else if(empty($programme)) {
	$_SESSION['err_message'] = "Please select programmeme";
}
else if(empty($gender)) {
	$_SESSION['err_message'] = "Please select gender";
}
else if(empty($dob)) {
	$_SESSION['err_message'] = "Please select date of birth";
}
else if(empty($address)) {
	$_SESSION['err_message'] = "Please candidate address";
}
else if(empty($phone)) {
	$_SESSION['err_message'] = "Please provide candidate phone number";
}

else if(empty($roleID)) {
	$_SESSION['err_message'] = "Please provide position for candidate";
}

else{
	$addedcandidate = $candidate->CreateCandidate($firstname,$lastname,$email,$programme,$gender,$dob,$address,$phone,$imageurl,$roleID);
	if ($addedcandidate === true) {

		$_SESSION['success_message'] = "Candidate Position created and is read to contest with others";
		move_uploaded_file($_FILES['imageurl']['tmp_name'], $imageurl);
		Redirect::redirectmeTo('Dash_Candidates.php');
	}
	else{
		$_SESSION['err_message'] = "Something went wrong please try again";
	}
}
}

?>

<div id="modal-primary" class="modal fade">
<div class="modal-dialog">
   <div class="modal-content">
        <div class="modal-header bg-primary">
             <h4 class="modal-title text-center" style="color:#fff;">Candidate Account</h4>
        </div>
        <div class="modal-body">

             <div class="row">
                <div class="col-md-12">

                    <form  method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                        <fieldset class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name" required="required">
                        </fieldset>
                        </div>
                        <div class="col-md-6">
                        <fieldset class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name" required="">
                    </fieldset>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                    <fieldset class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter Birthday" required="">
                    </fieldset>
                    </div>


                    <div class="col-md-6">
                    <fieldset class="form-group">
                        <label for="gender">Gender</label>
                       <select  class="form-control" name="gender">
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
                            <option value="Bsc Commerce ">Commerce</option>
                            <option value="Bsc Business Finance">Finance</option>
                            <option value="Bsc Peace and Govenance">Peace and Govenance</option>
                            <option value="Bsc Social Work">Social Work</option>
                            <option value="Bsc Computer Science">Computer Science</option>
                            <option value="Bsc Animal Science">Animal Science</option>
                        </select>
                    </fieldset>
                    </div>
                    <div class="col-md-6">
                    <fieldset class="form-group">
                        <label for="image">Profile Picture</label>
                            <input type="file" class="form-control" id="imageurl" name="imageurl" placeholder="upload Profile Picture" required="">
                    </fieldset>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <fieldset class="form-group">
                        <label for="telephone">Phone Number</label>
                        <input type="telephone" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required="">
                    </fieldset>
                    </div>
                    <div class="col-md-6">
                    <fieldset class="form-group">
                    <label for="telephone">Position</label>
                    <select  class="form-control" name="roleID">
                            <option value="0">Select Position</option>
                            <?php foreach ($positions  as $position): ?>
                                 <option value="<?php echo $position['id']; ?>"><?php echo $position['name']; ?></option>
                            <?php endforeach ?>

                        </select>
                    </fieldset>
                    </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block" id="btnsubmit" name="btnsubmit"> Create Account <i class="fa fa-sign-in-alt"></i></button>
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