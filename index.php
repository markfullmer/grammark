<?php 
include ('header.php');
include('microtimestart.php');
if (isset($_GET['id']) && $_GET['id'] == 'start') { $_SESSION['text'] = '0';}
if (isset($_POST['text'])) { $_SESSION['text'] = $_POST['text'];}
if (isset($_SESSION['text']) && $_SESSION['text'] != '0')  {
	include ('menu.php');
	if (empty($_GET['id'])) { include('variables.php'); include('default.php'); }
		else { $page = $_GET['id']; include('variables.php'); include($page .'.php'); include('output.php'); }
	}
else { include ('form.php'); }
include ('footer.php');
?>

