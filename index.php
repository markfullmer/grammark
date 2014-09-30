<?php 
session_start();
include('microtimestart.php');
include('includes/head.tpl.php');
include('includes/nav.tpl.php'); 
?>
<?php echo '<body id="tab'. $tab .'">'; 
?>
<div id='wrap'>

<?php 
$pages = array('about','source','contact','wordiness-list','grammar-error-list','transitions-list','database-add');
if (isset($_GET['id']) && $_GET['id'] == 'start' ) { $_SESSION['text'] = '0'; } 
if (isset($_POST['text'])) { $_SESSION['text'] = $_POST['text'];}
if (isset($_GET['url']) && in_array($_GET['url'],$pages)) { 
	include("includes/" . $_GET['url'] . ".php");
}
elseif (isset($_SESSION['text']) && $_SESSION['text'] != '0') {
	include ('includes/menu.php');
	include('variables.php'); 
	if (empty($_GET['id'])) { 
		include('includes/default.php'); 
	}
	else { 
		$page = $_GET['id']; 
		include('includes/' . $page . '.php'); 
		include('includes/output.php'); 
	}
}
else { 
	include ('includes/form.php');
	include ('includes/sidebar.tpl.php');
}
?>
</div>
</body>
</html>

