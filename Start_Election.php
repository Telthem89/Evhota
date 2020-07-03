<?php
require_once 'classes/function.php';
if (!isset($_SESSION['admin_id'])) { Redirect::redirectmeTo('index.php');} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZEC voting system (Vhota)  : Start Election</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
	<link rel="stylesheet" href="css/style.css">
	<style></style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
	<a class="navbar-brand" href="Dashboard.php">ZEC voting system (Vhota)  </a>			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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
<div class="jumbotron mt-lg-2 text-center">
<div class="container">
				<h1>Election Period Calculation</h1><hr>
			</div>
		
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
            <div class="col-md-12">
			<div class="card ">
				<div class="card-header"><span class="float-right"><button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-primary">Set Elections Period</button></span></div>
				<div class="card-body">
			    <table class="table table-inverse table-hover">
               	<thead class="text-center">
               		<tr>
               			<th>Sr</th>
               			<th>Name</th>
               			<th>Starting Time</th>
               			<th>Stoping Time</th>
               			<th>Status</th>
               			<th>Date</th>
               			<th>Action</th>
               		</tr>
               	</thead>
               	<?php $results = Election::getElection(); $i = 0; ?>
               	<tbody class="text-center">
                    <?php if ($results == false): ?>
                    	<?php foreach ($results as $result):$i++; ?>
                    	<tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['electname']; ?></td>
                        <td><?php echo $result['start_time']; ?></td>
                        <td><?php echo $result['stop_time']; ?></td>
                        <td><?php echo $result['status']; ?></td>
                        <td><?php echo $result['date_aadded']; ?></td>
                     <td><a class="btn btn-danger" href="End.php?eleq=<?php echo $result['id']; ?>">End Election</a></td>
                      </tr>
                    	<?php endforeach ?>
                    	<?php else: ?>
                    		 <td colspan="7" class="text-danger text-uppercase"><b>No Record</b></td>
                    <?php endif ?>
               	</tbody>
               </table>
				</div>
			</div>
            </div>
		</div>
	</div>
</section>

 ?>
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
</body>
</html>

<?php
if (isset($_POST['btnsubmit'])) {

	$electionName= htmlentities(trim($_POST['electionName']));
	$startTimey= $_POST['startTime'];
	$endtimey= $_POST['endtime'];
	$date_aaddedy= $_POST['date_aadded'];

	$startTime = date('H:i:s',strtotime($startTimey));
    $endtime = date('H:i:s',strtotime($endtimey));
    $date_aadded = date('Y-m-d',strtotime($date_aaddedy));

	if (empty($electionName)) {
	$_SESSION['err_message'] = "Election type is required";
	echo "<script>alert('Election type is required')</script>";
}
else if(empty($startTime)) {
	$_SESSION['err_message'] = "Starting time is required";
	echo "<script>alert('Starting time is required')</script>";
}
else if(empty($endtime)) {
	$_SESSION['err_message'] = "Stopping time is required";
	echo "<script>alert('Stopping time is required')</script>";
}

else if(empty($date_aadded)) {
	$_SESSION['err_message'] = "Election date is required";
	echo "<script>alert('Election date is required')</script>";
}

else{
	$result=Election::startElection($electionName,$startTime,$endtime,$date_aadded);
	if ($result==true) {
		echo "<script>alert('Successfully added election')</script>";
	}
	else{
		echo "<script>alert('fail to add election please try again')</script>";
		return false;
	}
}

}	
?>

<div id="modal-primary" class="modal fade">
<div class="modal-dialog">
   <div class="modal-content">
        <div class="modal-header bg-primary">
             <h4 class="modal-title text-center" style="color:#fff; text-align: center !important;">ELECTION SETTING PANEL</h4>
        </div>
        <div class="modal-body">

             <div class="row">
                <div class="col-md-12">

                    <form  method="POST" enctype="multipart/form-data">
                    <fieldset class="form-group">
                        <label for="election">Election Type</label>
                       <select  class="form-control" name="electionName">
                            <option value="0">Select Election Type</option>
                            <option value="SRC ELECTIONS">SRC ELECTIONS</option>
                            <option value="STAFF ELECTIONS">STAFF ELECTIONS</option>
                        </select>
                    </fieldset>
                     <fieldset class="form-group">
                        <label for="startTime">Starting Time</label>
                        <input type="time" class="form-control" id="startTime" name="startTime"  required="">
                    </fieldset>

                    
                        <label for="endtime">Stopping Time</label>
                        <input type="time" class="form-control" id="endtime" name="endtime" required="required">
                        </fieldset>
                 
                   <fieldset class="form-group">
                        <label for="date_aadded">Election Date</label>
                        <input type="datetime-local" class="form-control" id="date_aadded" name="date_aadded"  required="">
                    </fieldset>
                   

                    <button type="submit" class="btn btn-success btn-block" id="btnsubmit" name="btnsubmit"> Set Election <i class="fa fa-sign-in-alt"></i></button>
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