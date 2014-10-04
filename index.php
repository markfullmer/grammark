<?php
session_start();
require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(

));
//  add to above for caching: 'cache' => 'cache/compilation_cache',
echo $twig->render('index.twig', array('name' => 'Fabien'));
include('microtimestart.php');
include('settings.php');
include('includes/head.tpl.php');
?>
<?php echo '<body id="tab'. $tab .'">';
//include_once('js/analyticstracking.php');
include('includes/nav.tpl.php');
?>
<div id='wrap'>

<?php
$pages = array(
	'about',
	'source',
	'contact',
	'wordiness-list',
	'grammar-error-list',
	'transitions-list',
	'database-add'
);
if (isset($_GET['id']) && $_GET['id'] == 'start' ) { $_SESSION['text'] = '0'; }
if (isset($_POST['text'])) { $_SESSION['text'] = $_POST['text'];}
if (isset($_GET['url']) && in_array($_GET['url'],$pages)) {
	include("includes/" . $_GET['url'] . ".php");
}
elseif (isset($_SESSION['text']) && $_SESSION['text'] != '0') {
	include('mysql.php');
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
<script src="//cdnjs.cloudflare.com/ajax/libs/foundation/5.4.5/js/vendor/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/foundation/5.4.5/js/foundation.min.js"></script>
<script>
   $(document).foundation();
</script>
</body>
</html>

