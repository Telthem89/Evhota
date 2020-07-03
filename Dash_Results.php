<?php
require_once 'classes/function.php';
if (!isset($_SESSION['admin_id'])) { Redirect::redirectmeTo('index.php');} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZEC voting system (Vhota) : Results Panel</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
	<link rel="stylesheet" href="css/style.css">

		<script type="text/javascript" src="./js/apexcharts.js"></script>
		<script type="text/javascript" src="./js/apexcharts.amd.js"></script>
		<script type="text/javascript" src="./js/apexcharts.min.js"></script>
		<script type="text/javascript" src="./js/controller.js"></script>
	<style>
		#chart {
			max-width: 650px;
			margin: 35px auto;
			}
	</style>
</head>
<body onload="getSales()">
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
<div class="jumbotron mt-lg-5 ">
<div class="container">
				<h1 class="text-center">ELECTIONS RESULTS PANEL</h1><hr>
			</div>
		<div class="row">
            <div class="col-md-12">
				<table class="table table-bordered table-inverse table-hover">
					<thead class="bg-dark text-light">
						<tr>
							<th>#</th>
							<th>Candidate Name</th>
							<th>Position</th>
							<th>Total Number of votes</th>
							<th class="text-center">Status</th>
						</tr>
					</thead>
					<?php $candidates = CastVote::getJSON();

					 $i =0;?>
					<tbody>
						<?php if ($candidates == false): ?>
							<tr>
								<td colspan="5" class="text-danger text-center">NO RESULTS</td>
							</tr>
							<?php else: ?>
								<?php foreach ($candidates as $candidate):$i++; ?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $candidate['fullname']; ?></td>
										<td><?php echo $candidate['name']; ?></td>
										<td class="text-center"><?php echo $candidate['numbervote']; ?></td>
										<td class="text-center">
											<?php $thewinner = CastVote::getWinner($candidate['cid'],$candidate['roleid']); 
											$getstatus =Election::getElectionStatus();?>
											<?php foreach ($getstatus as $getme): ?>
												<?php if ($getme['status']=="Completed"): ?>

										        <?php foreach ($thewinner as $winner): ?>
                                                        <?php if ($candidate['numbervote']==$winner['totalVote']): ?>
                                                        <b class="badge badge-success"> WINNER!!
                                                        </b>
                                                        <?php else: ?>
                                                         <b class="badge badge-danger"> LOSER!!
                                                        </b>
                                                    <?php endif ?>
                                                    <?php endforeach ?>
                                                    <?php else: ?>
                                                    	<tr>Pending</tr>
                                                <?php endif ?>
                                                    <?php endforeach ?>
									</td>
									</tr>
								<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
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
	
<script src="./js/jquery.min.js"></script>
   <script src="./js/bootstrap.min.js"></script>
   <script src="./js/all.min.js"></script>
   
<script type="text/javascript">
	var options = {
chart: {
type: 'line'
},
series: [{
name: 'sales',
data: [9130,5640,9045,34450,7849,12360,90570,89091,21125]
}],
xaxis: {
categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul", "Aug","Sep","Oct","Nov","Dec"]
}
}
var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
</script>
</body>
</html>