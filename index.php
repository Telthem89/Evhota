<?php
  require_once './classes/init.php';

 ?>
<?php if (isset($_SESSION['stud'])) { Redirect::redirectmeTo('home.php');} ?>
<?php
	if (isset($_POST['btnsubmit'])){
    $stud_id = trim($_POST['username']);
    $password = trim(md5($_POST['password']));
     
    if (empty($stud_id)) {
    	$_SESSION['err_message'] ="Student number is required";
    }
    elseif (empty($password)) {
    	$_SESSION['err_message'] ="Password is required";
    }
    else{
      $database = new Database();
      $sql ="SELECT * FROM voters WHERE stud_id =:stud_id  AND `password` =:password";
      $stmt = $database->conn->prepare($sql);
      $stmt->execute(array(
                    ':stud_id' => $stud_id,
                    ':password' => $password
                    ));
      $result_found= $stmt->fetch(PDO::FETCH_ASSOC);
            if($result_found == false){
                  $_SESSION['err_message'] ="Incorrect credentials please try again!!";

             }else{
             	$_SESSION['stud'] = $result_found['stud_id'];
                $_SESSION['fullname'] =$result_found['firstname']." ".$result_found['lastname'];
                 Redirect::redirectmeTo('students');
             }
    }

       
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZEC voting system (Vhota) : Voter</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
	<!-- <link rel="stylesheet" href="./css/style.css"> -->
	<style></style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
    <a class="navbar-brand" href="#">ZEC voting system (Vhota) </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="#">ABOUT</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">LOGIN</i></a>
					</li>
				</ul>
				
			</div>
    </div>
</nav>

<p><br></p>
<p><br></p>
<p><br></p>
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="telthem">
					<h2 class="header text-center">ZEC voting system (Vhota) <i class="fa fa-vote-yea"></i></h2><br>
				   <?php if (isset( $_SESSION['err_message'])): ?>
                                <div class="alert alert-danger text-center alert-dismissible" role="alert">
                                    <strong>Wrong!</strong> <?php echo  $_SESSION['err_message']; ?>
                                    <i class="fas fa-closed"></i>
                                    <span class='close' data-dismiss='alert'>&times;</span>
                                </div>
                            <?php endif ?>
							<form action="#" method="POST">
								<div class="form-group">
									<label for="username">Student Number</label>
									<input type="text" name="username" id="username" class="form-control" placeholder="Student Reg Number">
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" name="password" id="password" class="form-control" placeholder="Password">
								</div>
								<button type="submit" class="btn btn-primary btn-block" name="btnsubmit">Login <i class="fa fa-sign-in-alt"></i> </button>
							</form>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
  <section class="text-center">
<footer class="footer">
      <div class="container">
        <span class="text-muted">&copy 2020 Copyright All Reserved for : <a href="https://www.telthemweb.co.zw">Blessing Muchembere</a></span>
      </div>
    </footer>
</section>
	<script src="./js/jquery.min.js"></script>
   <script src="./js/bootstrap.min.js"></script>
   <script src="./js/all.min.js"></script>
   <script src="./js/Controller.js"></script>
</body>
</html>