<?php
require_once 'classes/function.php';
if (!isset($_SESSION['admin_id'])) { Redirect::redirectmeTo('index.php');} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZEC voting system (Vhota) : Add Voter</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
	<link rel="stylesheet" href="css/style.css">
      <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- JQVMap -->
	<style></style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
    <a class="navbar-brand" href="#">ZEC voting system (Vhota)</a>
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
	<h1>Voter Registration Panel</h1><i class="fa fa-vote-yea fa-9x text-primary"></i><hr>
	<button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-primary">Add Voter</button>
</div>
</div>
<p></p>

</section>
<section>
<div class="container">
    <div class="row">
        <div class="col-md-12">
               <table id="example1" class="table table-responsive table-hover">
               	<thead class="text-center bg-info" style="color:#fff;">
               		<tr>
               			<th>#</th>
                    <th>RollNo</th>
               			<th>Name</th>
               			<th>Surname</th>
               			<th>Email</th>
               			<th>Gender</th>
               			<th>DOB</th>
               			<th>Phone</th>
               			<th>Action</th>
               		</tr>
               	</thead>
               	<tbody>
                  <?php  $Voters = Voters::getAllVoters();
                  $i =1; ?>
                  <?php if ($Voters ==false): ?>
                    <tr>
                      <td colspan="7">No voter yet</td>
                    </tr>
                    <?php else: ?>
                      <?php foreach ($Voters as $voter): $i++;?>
                         <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $voter['stud_id']; ?></td>
                          <td><?php echo $voter['firstname']; ?></td>
                          <td><?php echo $voter['lastname']; ?></td>
                          <td><?php echo $voter['email']; ?></td>
                          <td><?php echo $voter['gender']; ?></td>
                          <td><?php echo $voter['dob']; ?></td>
                          <td><?php echo $voter['phone']; ?></td>
                       <td><a class="text-success" href="edit.php?stid=<?php echo $voter['stud_id']; ?>">Edit</a> | <a class="text-danger"  href="delete.php?stid=<?php echo $voter['stud_id']; ?>">Trash</a> </td>
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
<?php require_once 'modalVoter.php'; ?>
<script src="./js/jquery.min.js"></script>
   <script src="./js/bootstrap.min.js"></script>
   <!-- DataTables -->
<script src="./plugins/datatables/jquery.dataTables.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
   <script src="./js/all.min.js"></script>
   <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>