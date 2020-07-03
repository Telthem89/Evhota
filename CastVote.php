<?php
require_once '../classes/init.php';
if (!isset($_SESSION['stud'])) { Redirect::redirectmeTo('index.php');}?>

<?php $id = $_GET['vote'] 
echo base64_encode($id);
?>
