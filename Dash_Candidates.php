<?php
require_once 'classes/function.php';
if (!isset($_SESSION['admin_id'])) { Redirect::redirectmeTo('index.php');} ?>
<?php
$candidate = new Candidate();
$President = $candidate->getCandidatesPostionPresident();
$VicePresident = $candidate->getCandidatesPostionVicePresident();
$Secretary = $candidate->getCandidatesPostionSecretary();
$Finance = $candidate->getCandidatesPostionFinance();
$positions = $candidate->getCandidatesPostion();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZEC voting system (Vhota): Add Candidate</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
	<link rel="stylesheet" href="css/style.css">
	<style></style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
    <a class="navbar-brand" href="Dashboard.php">ZEC voting system (Vhota) </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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
<div class="jumbotron mt-lg-5 text-center">
<div class="container">
   <h1>Candidate Registration Panel </h1> <i class="fa fa-vote-yea fa-9x text-primary"></i><hr>

   <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-primary">Add Candidate</button>
</div>
</div>
</section>
<section>
<div class="container">
<div class="text-center">
    <?php if (isset( $_SESSION['success_message'])): ?>
                <div class="alert alert-success text-center alert-dismissible" role="alert">
                    <strong>Success!</strong> <?php echo  $_SESSION['success_message']; ?>
                    <i class="fas fa-check"></i>
                    <span class='close' data-dismiss='alert'>&times;</span>
                </div>
                <?php elseif (isset( $_SESSION['err_message'])): ?>
                <div class="alert alert-danger text-center alert-dismissible" role="alert">
                    <strong>Error! </strong> <?php echo  $_SESSION['err_message']; ?>
                    <i class="fa fa-block"></i>
                    <span class='close' data-dismiss='alert'>&times;</span>
                </div>
            <?php endif ?>
</div>
		<!-- President -->

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">President</div>
				<div class="card-body">
					<div class="row">
				<!-- strart col-md-3 -->
				<?php if ($President ==true): ?>
                 <?php foreach ($President as $president): ?>
				<div class="col-md-4">
					<div class="card text-center">
						<img class="card-img-top" src="<?php echo $president['imageurl']; ?>" alt="Card image cap">
						<div class="card-body">
							<h4 class="card-title"><?php echo $president['fullname']; ?></h4><hr>
							<b><?php echo $president['programme']; ?></b><br><br>
							<a href="<?php echo $president['id']; ?>" class="btn btn-primary">Edit</a>
							<a href="<?php echo $president['id']; ?>" class="btn btn-danger">Trash</a>
						</div>
					</div>
				</div>
				<!-- end col-md-3 -->
				<?php endforeach ?>
                	<?php else: ?>
                	<!-- strart col-md-3 -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body text-center ">
                                     <p class='text-danger'><b class="text-center">No Candidate for this Post</b></p>
                                </div>
                            </div>
                        </div>
                        <!-- end col-md-3 -->
                    <?php endif ?>
			     </div>
				</div>
			</div>
		</div>
	</div><br>

	<!-- end President -->


    		<!-- Vice President -->
            	<div class="row">
            		<div class="col-md-12">
            			<div class="card">
            				<div class="card-header">Vice President</div>
            				<div class="card-body">
            					<div class="row">
            				<!-- strart col-md-3 -->
            				<?php if ($VicePresident ==true): ?>
                             <?php foreach ($VicePresident as $vpresident): ?>
            				<div class="col-md-4">
            					<div class="card text-center">
            						<img class="card-img-top" src="<?php echo $vpresident['imageurl']; ?>" alt="Card image cap">
            						<div class="card-body">
            							<h4 class="card-title"><?php echo $vpresident['fullname']; ?></h4><hr>
            							<b><?php echo $vpresident['programme']; ?></b><br><br>
            							<a href="<?php echo $vpresident['id']; ?>" class="btn btn-primary">Edit</a>
    							<a href="<?php echo $finance['id']; ?>" class="btn btn-danger">Trash</a>
            						</div>
            					</div>
            				</div>
            				<?php endforeach ?>
                                    	<?php else: ?>
                                            <!-- strart col-md-3 -->
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body text-center ">
                                                         <p class='text-danger'><b class="text-center">No Candidate for this Post</b></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col-md-3 -->
                                    	<?php endif ?>
            				<!-- end col-md-3 -->
            			     </div>
            				</div>
            			</div>
            		</div>
            	</div><br>

            	<!-- end President -->

    		<!-- Secretary -->

    	<div class="row">
    		<div class="col-md-12">
    			<div class="card">
    				<div class="card-header">Secretary</div>
    				<div class="card-body">
    					<div class="row">
    					<?php if ($Secretary ==true): ?>
                         <?php foreach ($Secretary as $secret): ?>
    				<!-- strart col-md-3 -->
    				<div class="col-md-4">
    					<div class="card text-center">
    						<img class="card-img-top" src="<?php echo $secret['imageurl']; ?>" alt="Card image cap">
    						<div class="card-body">
    							<h4 class="card-title"><?php echo $secret['fullname']; ?></h4><hr>
    							<b><?php echo $secret['programme']; ?></b><br><br>
    							<a href="<?php echo $secret['id']; ?>" class="btn btn-primary">Edit</a>
    							<a href="<?php echo $finance['id']; ?>" class="btn btn-danger">Trash</a>
    						</div>
    					</div>
    				</div>
    				<!-- end col-md-3 -->
    					<?php endforeach ?>
                    	<?php else: ?>
                    	<!-- strart col-md-3 -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body text-center ">
                                         <p class='text-danger'><b class="text-center">No Candidate for this Post</b></p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col-md-3 -->
                    	<?php endif ?>
    			     </div>
    				</div>
    			</div>
    		</div>
    	</div><br>

    		<!-- end Secretary -->

    		 <!-- Minister of Finance -->

    	<div class="row">
    		<div class="col-md-12">
    			<div class="card">
    				<div class="card-header">Minister of Finance</div>
    				<div class="card-body">
    					<div class="row">
    					<?php if ($Finance ==true): ?>
                         <?php foreach ($Finance as $finance): ?>
    				<!-- strart col-md-3 -->
    				<div class="col-md-4">
    					<div class="card text-center">
    						<img class="card-img-top" src="<?php echo $finance['imageurl']; ?>" alt="Card image cap">
    						<div class="card-body">
    							<h4 class="card-title"><?php echo $finance['fullname']; ?></h4><hr>
    							<b><?php echo $finance['programme']; ?></b><br><br>
    							<a href="<?php echo $finance['id']; ?>" class="btn btn-primary">Edit</a>
    							<a href="<?php echo $finance['id']; ?>" class="btn btn-danger">Trash</a>
    						</div>
    					</div>
    				</div>
    				<!-- end col-md-3 -->
                    <?php endforeach ?>
                    <?php else: ?>
                    <!-- strart col-md-3 -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body text-center ">
                                     <p class='text-danger'><b class="text-center">No Candidate for this Post</b></p>
                                </div>
                            </div>
                        </div>
                        <!-- end col-md-3 -->
                    <?php endif ?>
    			     </div>
    				</div>
    			</div>
    		</div>
    	</div><br>

		<!-- end Finance -->

</div>

</section>

<section class="text-center">
<footer class="footer">
			<div class="container">
				<span class="text-muted">&copy 2020 Copyright All Reserved for : <a href="https://www.telthemweb.co.zw">Blessing Muchembere</a></span>
			</div>
		</footer>
</section>
<?php require_once 'modalp.php'; ?>
    <script src="./js/jquery.min.js"></script>
   <script src="./js/bootstrap.min.js"></script>
   <script src="./js/all.min.js"></script>
</body>
</html>