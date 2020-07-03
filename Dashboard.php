<?php
require_once 'classes/function.php';
if (!isset($_SESSION['admin_id'])) { Redirect::redirectmeTo('index.php');} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZEC voting system (Vhota) : ZEC</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/Chart.min.css">
	<link rel="stylesheet" href="css/style.css">
	<style></style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
    <a class="navbar-brand" href="Dashboard.php">ZEC voting system (Vhota) </a>			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="Dash_Voters.php">VOTERS <i class="fa fa-user"></i></span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="Dash_Candidates.php">CANDIDATES <i class="fa fa-user"></i></a>
                    </li>
                    <li class="nav-item">
						<a class="nav-link" href="Dash_Results.php">RESULTS <i class="fa fa-vote-yea"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout.php">LOGOUT <i class="fa fa-sign-out-alt"></i></a>
					</li>
				</ul>
				
			</div>
    </div>
</nav>
<section class="mt-lg-5">
<div class="container">
		<div class="row">
            <div class="col-md-12">
			<div class="jumbotron mt-lg-5">
				<h1>Vote <b class="float-right badge badge-white">
                    <?php 
                    $rs = Election::getElectionStatus();
                    $time = Election::getTimeofElectiontoKickoff();
                     ?> 
                    <?php foreach ($time as $timey): ?>
                        <?php if ($timey['totalLeft']==0): ?>
                        <?php if ($rs>0): ?>
                        <?php foreach ($rs as $r): ?>
                    <p><?php 
                      if ($r['status']=="Completed") {
                            echo "<b class='text-danger'>Elections  ".$r['status']."</b>";
                        }
                        else{
                            echo "<b class='text-success'>Elections  ".$r['status']."</b>";
                        }  

                    ?></p>         
                     <?php endforeach ?>  

                     <?php else: ?>
                          echo "No Elections"      
                    <?php endif ?>

                        <?php else: ?>
                        <?php echo "we have ".$timey['totalLeft']." hrs to go"; ?>   
                          <?php endif ?>    
                     <?php endforeach ?>         
                </b></h1><hr>
				<p class="lead">ZEC voting system (Vhota), was developed by Blessing Muchembere @ buse B1850574 as partially fullment of mini software project</p>
				<p class="text-center">
                    <div class="row">
                        <div class="col-md-2"></div>
                       <div class="col-md-8">
                        <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Add Voters <b class="float-right text-success"><a class="btn btn-danger" href="Dash_Voters.php">Add</a></b></li>
                            <li class="list-group-item">Add Candidates <b class="float-right text-success"><a class="btn btn-danger" href="Dash_Candidates.php">Add</a></b></li>
                            <li class="list-group-item">View Results <b class="float-right text-success"><a class="btn btn-danger" href="Dash_Results.php">View</a></b></li>
                            <li class="list-group-item">Start Election <b class="float-right text-success"><a class="btn btn-danger" href="Start_Election.php">Start</a></b></li>

                        </ul>
                        </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                
                </p>
			</div>
            </div>
		</div>
	</div>
</section>

<section class="text-center">
<footer class="footer">
			<div class="container">
				<span class="text-muted">&copy 2020 Copyright All Reserved for : <a href="https://www.telthemweb.co.zw">Blessing Muchembere</a></span>
			</div>
		</footer>
</section>

<?php 
    if (header("refresh:5;url=Dashboard.php")) {
        $user = Election::updateTimeofElectiontoKickoff();
        if ($user==true) {
           echo "<script>alert('hello')</script>";
        }
    }

 ?>
	
   <script src="./js/jquery.min.js"></script>
   <script src="./js/bootstrap.min.js"></script>
   <script src="./js/all.min.js"></script>
   <script src="./js/Controller.js"></script>
   <script src="./js/Chart.min.js"></script>
</body>
</html>