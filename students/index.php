<?php
require_once '../classes/init.php';
if (!isset($_SESSION['stud'])) { Redirect::redirectmeTo('index.php');}?>

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
    <title>ZEC voting system (Vhota) : Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<style>
     .fa-star{
        color: yellow
     }   
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
    <a class="navbar-brand" href="Dashboard.php">ZEC voting system (Vhota)</b></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
						<a class="nav-link" href="#">Help <i class="fa fa-info"></i></a>
					</li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About <i class="fa fa-globe"></i></a>
                    </li>
					<li class="nav-item">
						<a class="nav-link" href="logout.php">Hi <?php echo $_SESSION['fullname'] ?> <i class="fa fa-sign-out-alt"></i></a>
					</li>
                    
				</ul>
				
			</div>
    </div>
</nav>
<p><br></p>
<section class="mt-lg-5">

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
            <div class="jumbotron text-center rounded">
                <h3><b class="bg-info p-3 rounded-circle text-light">ZEC</b> voting system (Vhota)</h3><br><hr>
                <p>Designed by <b class="text-danger">B</b>lessing <b class="text-danger">M</b>uchembere @ Bindura University B1850574 as partially fulfilment of mini software project <br>   
                   <div class="stars">
                    <b>Reviews :450 </b><br> 
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                   </div>
                   <br>
                   <p>
                       <h1> <b class="float-right badge badge-white">
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
                   </p>
                </p>
            </div>
              <?php if ($rs==false): ?>
            <h1 class="text-center text-danger">No election yet</h1>

            <?php else: ?>
            <?php foreach ($rs as $r): ?>
              
                    
                
            <?php if ($r['status']=="In Progress"): ?>
                
            
			<div class="card">
				<div class="card-header">PRESIDENT </div>
				<div class="card-body">
					<div class="row">
				<!-- strart col-md-3 -->
				<?php if ($President ==true): ?>
                 <?php foreach ($President as $president): ?>
				<div class="col-md-4">
					<div class="card text-center">
						<img class="card-img-top" src=".<?php echo $president['imageurl']; ?>" alt="Card image cap">
						<div class="card-body">
							<h4 class="card-title"><?php echo $president['fullname']; ?></h4><hr>
							<b><?php echo $president['programme']; ?></b><br><br>
							<input type="hidden" name="roleid" value="<?php echo $president['rolid']; ?>">
							<input type="hidden" name="roleid" value="<?php echo $president['cid']; ?>">
							<?php 
                            $getstatus =Election::getElectionStatus();
                            $thewinner =CastVote::getWinner($president['id'],$president['rolid']);
                            //echo json_encode($thewinner);
							$totals = CastVote::getVotes($president['id']);
							$user =CastVote::checkifVoted($_SESSION['stud'], $president['rolid']); ?>
							<?php if (!$user): ?>
								<a href="CastVote.php?roleid=<?php echo $president['rolid']; ?>&stid=<?php echo $_SESSION['stud']; ?>&candidate=<?php echo $president['id']; ?>" class="btn btn-success">Vote</a>
								<?php else: ?>

									<?php if ($totals == false): ?>
										<?php else: ?>
										<?php foreach ($totals as $total): ?>
											<?php if ( $total['numbervote'] ==0): ?>
                                                <a href="#" class="btn btn-secondary">0</a>
                                               <?php else: ?>
                                               <a href="#" class="btn btn-secondary"><?php echo $total['numbervote']; ?></a>  <br>   
                                             <?php endif ?>
                                              <?php foreach ($getstatus as $getme): ?>
                                                <?php if ($getme['status']=="Completed"): ?>
                                                    
                                                        <?php foreach ($thewinner as $winner): ?>
                                                            <?php if ($total['numbervote']==$winner['totalVote']): ?>
                                                        <b class="badge badge-success"> WINNER!!
                                                        </b>
                                                        <?php else: ?>
                                                         <b class="badge badge-danger"> LOSER!!
                                                        </b>
                                                    <?php endif ?>
                                                    <?php endforeach ?>
                                                    
                                                    
                                                    
                                                 
                                                <?php endif ?>  
                                              <?php endforeach ?>
                                               
										<?php endforeach ?>	
									<?php endif ?>

									
							<?php endif ?>
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
            						<img class="card-img-top" src=".<?php echo $vpresident['imageurl']; ?>" alt="Card image cap">
            						<div class="card-body">
            							<h4 class="card-title"><?php echo $vpresident['fullname']; ?></h4><hr>
            							<b><?php echo $vpresident['programme']; ?></b><br><br>
            							<input type="hidden" name="roleid" value="<?php echo $vpresident['rolid']; ?>">
                                        <input type="hidden" name="roleid" value="<?php echo $vpresident['id']; ?>">
            							<?php 
                                        $thewinner =CastVote::getWinner($vpresident['id'],$vpresident['rolid']);
            							$totals = CastVote::getVotes($vpresident['id']);
            							$user =CastVote::checkifVoted($_SESSION['stud'], $vpresident['rolid']); ?>
            							<?php if (!$user): ?>
            								<a href="CastVote.php?roleid=<?php echo $vpresident['rolid']; ?>&stid=<?php echo $_SESSION['stud']; ?>&candidate=<?php echo $vpresident['id']; ?>" class="btn btn-success">Vote</a>

            								<?php else: ?>
            							
            							<?php if ($totals ==false): ?>
										<a href="#" class="btn btn-secondary">Null</a>
										<?php else: ?>
										<?php foreach ($totals as $total): ?>
											<?php if ( $total['numbervote'] ==0): ?>
                                                <a href="#" class="btn btn-secondary">0</a>
                                               <?php else: ?>
                                               <a href="#" class="btn btn-secondary"><?php echo $total['numbervote']; ?></a>     
                                             <?php endif ?> 
                                              <?php foreach ($getstatus as $getme): ?>
                                                <?php if ($getme['status']=="Completed"): ?>
                                                    
                                                        <?php foreach ($thewinner as $winner): ?>
                                                        <?php if ($total['numbervote']==$winner['totalVote']): ?>
                                                        <b class="badge badge-success"> WINNER!!
                                                        </b>
                                                        <?php else: ?>
                                                         <b class="badge badge-danger"> LOSER!!
                                                        </b>
                                                    <?php endif ?>
                                                    <?php endforeach ?>
                                                    
                                                    
                                                    
                                                 
                                                <?php endif ?>  
                                              <?php endforeach ?>	
										<?php endforeach ?>	
										<?php endif ?>
    							<?php endif ?>
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
    						<img class="card-img-top" src=".<?php echo $secret['imageurl']; ?>" alt="Card image cap">
    						<div class="card-body">
    							<h4 class="card-title"><?php echo $secret['fullname']; ?></h4><hr>
    							<b><?php echo $secret['programme']; ?></b><br><br>
    							<input type="hidden" name="roleid" value="<?php echo $secret['rolid']; ?>">
                                <input type="hidden" name="cvid" value="<?php echo $secret['id']; ?>">
    							<?php 
                                 $sthewinner =CastVote::getWinner($secret['id'],$secret['rolid']);
    							$totals = CastVote::getVotes($secret['id']);
    							$user =CastVote::checkifVoted($_SESSION['stud'], $secret['rolid']); ?>
							<?php if (!$user): ?>
								<a href="CastVote.php?roleid=<?php echo $secret['rolid']; ?>&stid=<?php echo $_SESSION['stud']; ?>&candidate=<?php echo $secret['id']; ?>" class="btn btn-success">Vote</a>
								<?php else: ?>
									<?php if ($totals ==false): ?>
									<a href="#" class="btn btn-secondary">Null</a>
									<?php else: ?>
									<?php foreach ($totals as $total): ?>
										<?php if ( $total['numbervote'] ==0): ?>
                                                <a href="#" class="btn btn-secondary">0</a>
                                               <?php else: ?>
                                               <a href="#" class="btn btn-secondary"><?php echo $total['numbervote']; ?></a>     
                                             <?php endif ?> 
                                              <?php foreach ($getstatus as $getme): ?>
                                                <?php if ($getme['status']=="Completed"): ?>
                                                   
                                                        <?php foreach ($sthewinner as $winner): ?>
                                                        <?php if ($total['numbervote']==$winner['totalVote']): ?>
                                                        <b class="badge badge-success"> WINNER!!
                                                        </b>
                                                        <?php else: ?>
                                                         <b class="badge badge-danger"> LOSER!!
                                                        </b>
                                                    <?php endif ?>
                                                    <?php endforeach ?>
                                                    
                                                    
                                                 
                                                <?php endif ?>  
                                              <?php endforeach ?>	
									<?php endforeach ?>	
									<?php endif ?>
							<?php endif ?>
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
    						<img class="card-img-top" src=".<?php echo $finance['imageurl']; ?>" alt="Card image cap">
    						<div class="card-body">
    							<h4 class="card-title"><?php echo $finance['fullname']; ?></h4><hr>
    							<b><?php echo $finance['programme']; ?></b><br><br>
    							<input type="hidden" name="roleid" value="<?php echo $finance['rolid']; ?>">
    							<input type="hidden" name="cvid" value="<?php echo $finance['id']; ?>">
                                <?php 
                                 $thewinner =CastVote::getWinner($finance['id'],$finance['rolid']);
    							$totals = CastVote::getVotes($finance['id']);
    							 $user =CastVote::checkifVoted($_SESSION['stud'], $finance['rolid']); ?>
							<?php if (!$user): ?>
								<a href="CastVote.php?roleid=<?php echo $finance['rolid']; ?>&stid=<?php echo $_SESSION['stud']; ?>&candidate=<?php echo $finance['id']; ?>" class="btn btn-success">Vote</a>
								<?php else: ?>
									<?php if ($totals ==false): ?>
									<a href="#" class="btn btn-secondary">Null</a>
									<?php else: ?>
									<?php foreach ($totals as $total): ?>
										<?php if ( $total['numbervote'] ==0): ?>
                                                <a href="#" class="btn btn-secondary">0</a>
                                               <?php else: ?>
                                               <a href="#" class="btn btn-secondary"><?php echo $total['numbervote']; ?></a>     
                                             <?php endif ?> 
                                              <?php foreach ($getstatus as $getme): ?>
                                                <?php if ($getme['status']=="Completed"): ?>
                                                  
                                                        <?php foreach ($thewinner as $winner): ?>
                                                        <?php if ($total['numbervote']==$winner['totalVote']): ?>
                                                        <b class="badge badge-success"> WINNER!!
                                                        </b>
                                                        <?php else: ?>
                                                         <b class="badge badge-danger"> LOSER!!
                                                        </b>
                                                    <?php endif ?>
                                                    <?php endforeach ?>
                                                    
                                                    
                                                 
                                                <?php endif ?>  
                                              <?php endforeach ?>	
									<?php endforeach ?>	
									<?php endif ?>
							<?php endif ?>
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
        <?php else: ?>

            <div class="card">
                <div class="card-header">PRESIDENT </div>
                <div class="card-body">
                    <div class="row">
                <!-- strart col-md-3 -->
                <?php if ($President ==true): ?>
                 <?php foreach ($President as $president): ?>
                <div class="col-md-4">
                    <div class="card text-center">
                        <img class="card-img-top" src=".<?php echo $president['imageurl']; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $president['fullname']; ?></h4><hr>
                            <b><?php echo $president['programme']; ?></b><br><br>
                            <input type="hidden" name="roleid" value="<?php echo $president['rolid']; ?>">
                            <input type="hidden" name="roleid" value="<?php echo $president['cid']; ?>">
                            <?php 
                            $getstatus =Election::getElectionStatus();
                            $thewinner =CastVote::getWinner($president['id'],$president['rolid']);
                            //echo json_encode($thewinner);
                            $totals = CastVote::getVotes($president['id']);
                            $user =CastVote::checkifVoted($_SESSION['stud'], $president['rolid']); ?>
                            <?php if (!$user): ?>
                                <a href="CastVote.php?roleid=<?php echo $president['rolid']; ?>&stid=<?php echo $_SESSION['stud']; ?>&candidate=<?php echo $president['id']; ?>" class="btn btn-success">Vote</a>
                                <?php else: ?>

                                    <?php if ($totals == false): ?>
                                        <?php else: ?>
                                        <?php foreach ($totals as $total): ?>
                                            <?php if ( $total['numbervote'] ==0): ?>
                                                <a href="#" class="btn btn-secondary">0</a>
                                               <?php else: ?>
                                               <a href="#" class="btn btn-secondary"><?php echo $total['numbervote']; ?></a>  <br>   
                                             <?php endif ?>
                                              <?php foreach ($getstatus as $getme): ?>
                                                <?php if ($getme['status']=="Completed"): ?>
                                                    
                                                        <?php foreach ($thewinner as $winner): ?>
                                                            <?php if ($total['numbervote']==$winner['totalVote']): ?>
                                                        <b class="badge badge-success"> WINNER!!
                                                        </b>
                                                        <?php else: ?>
                                                         <b class="badge badge-danger"> LOSER!!
                                                        </b>
                                                    <?php endif ?>
                                                    <?php endforeach ?>
                                                    
                                                    
                                                    
                                                 
                                                <?php endif ?>  
                                              <?php endforeach ?>
                                               
                                        <?php endforeach ?> 
                                    <?php endif ?>

                                    
                            <?php endif ?>
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
                                    <img class="card-img-top" src=".<?php echo $vpresident['imageurl']; ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $vpresident['fullname']; ?></h4><hr>
                                        <b><?php echo $vpresident['programme']; ?></b><br><br>
                                        <input type="hidden" name="roleid" value="<?php echo $vpresident['rolid']; ?>">
                                        <input type="hidden" name="roleid" value="<?php echo $vpresident['id']; ?>">
                                        <?php 
                                        $thewinner =CastVote::getWinner($vpresident['id'],$vpresident['rolid']);
                                        $totals = CastVote::getVotes($vpresident['id']);
                                        $user =CastVote::checkifVoted($_SESSION['stud'], $vpresident['rolid']); ?>
                                        <?php if (!$user): ?>
                                            <a href="CastVote.php?roleid=<?php echo $vpresident['rolid']; ?>&stid=<?php echo $_SESSION['stud']; ?>&candidate=<?php echo $vpresident['id']; ?>" class="btn btn-success">Vote</a>

                                            <?php else: ?>
                                        
                                        <?php if ($totals ==false): ?>
                                        <a href="#" class="btn btn-secondary">Null</a>
                                        <?php else: ?>
                                        <?php foreach ($totals as $total): ?>
                                            <?php if ( $total['numbervote'] ==0): ?>
                                                <a href="#" class="btn btn-secondary">0</a>
                                               <?php else: ?>
                                               <a href="#" class="btn btn-secondary"><?php echo $total['numbervote']; ?></a>     
                                             <?php endif ?> 
                                              <?php foreach ($getstatus as $getme): ?>
                                                <?php if ($getme['status']=="Completed"): ?>
                                                    
                                                        <?php foreach ($thewinner as $winner): ?>
                                                        <?php if ($total['numbervote']==$winner['totalVote']): ?>
                                                        <b class="badge badge-success"> WINNER!!
                                                        </b>
                                                        <?php else: ?>
                                                         <b class="badge badge-danger"> LOSER!!
                                                        </b>
                                                    <?php endif ?>
                                                    <?php endforeach ?>
                                                    
                                                    
                                                    
                                                 
                                                <?php endif ?>  
                                              <?php endforeach ?>   
                                        <?php endforeach ?> 
                                        <?php endif ?>
                                <?php endif ?>
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
                            <img class="card-img-top" src=".<?php echo $secret['imageurl']; ?>" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $secret['fullname']; ?></h4><hr>
                                <b><?php echo $secret['programme']; ?></b><br><br>
                                <input type="hidden" name="roleid" value="<?php echo $secret['rolid']; ?>">
                                <input type="hidden" name="cvid" value="<?php echo $secret['id']; ?>">
                                <?php 
                                 $sthewinner =CastVote::getWinner($secret['id'],$secret['rolid']);
                                $totals = CastVote::getVotes($secret['id']);
                                $user =CastVote::checkifVoted($_SESSION['stud'], $secret['rolid']); ?>
                            <?php if (!$user): ?>
                                <a href="CastVote.php?roleid=<?php echo $secret['rolid']; ?>&stid=<?php echo $_SESSION['stud']; ?>&candidate=<?php echo $secret['id']; ?>" class="btn btn-success">Vote</a>
                                <?php else: ?>
                                    <?php if ($totals ==false): ?>
                                    <a href="#" class="btn btn-secondary">Null</a>
                                    <?php else: ?>
                                    <?php foreach ($totals as $total): ?>
                                        <?php if ( $total['numbervote'] ==0): ?>
                                                <a href="#" class="btn btn-secondary">0</a>
                                               <?php else: ?>
                                               <a href="#" class="btn btn-secondary"><?php echo $total['numbervote']; ?></a>     
                                             <?php endif ?> 
                                              <?php foreach ($getstatus as $getme): ?>
                                                <?php if ($getme['status']=="Completed"): ?>
                                                   
                                                        <?php foreach ($sthewinner as $winner): ?>
                                                        <?php if ($total['numbervote']==$winner['totalVote']): ?>
                                                        <b class="badge badge-success"> WINNER!!
                                                        </b>
                                                        <?php else: ?>
                                                         <b class="badge badge-danger"> LOSER!!
                                                        </b>
                                                    <?php endif ?>
                                                    <?php endforeach ?>
                                                    
                                                    
                                                 
                                                <?php endif ?>  
                                              <?php endforeach ?>   
                                    <?php endforeach ?> 
                                    <?php endif ?>
                            <?php endif ?>
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
                            <img class="card-img-top" src=".<?php echo $finance['imageurl']; ?>" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $finance['fullname']; ?></h4><hr>
                                <b><?php echo $finance['programme']; ?></b><br><br>
                                <input type="hidden" name="roleid" value="<?php echo $finance['rolid']; ?>">
                                <input type="hidden" name="cvid" value="<?php echo $finance['id']; ?>">
                                <?php 
                                 $thewinner =CastVote::getWinner($finance['id'],$finance['rolid']);
                                $totals = CastVote::getVotes($finance['id']);
                                 $user =CastVote::checkifVoted($_SESSION['stud'], $finance['rolid']); ?>
                            <?php if (!$user): ?>
                                <a href="CastVote.php?roleid=<?php echo $finance['rolid']; ?>&stid=<?php echo $_SESSION['stud']; ?>&candidate=<?php echo $finance['id']; ?>" class="btn btn-success">Vote</a>
                                <?php else: ?>
                                    <?php if ($totals ==false): ?>
                                    <a href="#" class="btn btn-secondary">Null</a>
                                    <?php else: ?>
                                    <?php foreach ($totals as $total): ?>
                                        <?php if ( $total['numbervote'] ==0): ?>
                                                <a href="#" class="btn btn-secondary">0</a>
                                               <?php else: ?>
                                               <a href="#" class="btn btn-secondary"><?php echo $total['numbervote']; ?></a>     
                                             <?php endif ?> 
                                              <?php foreach ($getstatus as $getme): ?>
                                                <?php if ($getme['status']=="Completed"): ?>
                                                  
                                                        <?php foreach ($thewinner as $winner): ?>
                                                        <?php if ($total['numbervote']==$winner['totalVote']): ?>
                                                        <b class="badge badge-success"> WINNER!!
                                                        </b>
                                                        <?php else: ?>
                                                         <b class="badge badge-danger"> LOSER!!
                                                        </b>
                                                    <?php endif ?>
                                                    <?php endforeach ?>
                                                    
                                                    
                                                 
                                                <?php endif ?>  
                                              <?php endforeach ?>   
                                    <?php endforeach ?> 
                                    <?php endif ?>
                            <?php endif ?>
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
        <?php endif ?>
    <?php endforeach ?>
        <?php endif ?>
        <div class="text-center mb-lg-5">
            <button class="btn btn-success" style="display: none;" id="submitmeProcceed">Confirm Your Vote</button>
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
    <script src="../js/jquery.min.js"></script>
   <script src="../js/bootstrap.min.js"></script>
   <script src="../js/all.min.js"></script>
</body>
</html>