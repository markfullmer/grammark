<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'settings.php';
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(

));
//  add to above for caching: 'cache' => 'cache/compilation_cache',

$pages = array(
	'about', 'source', 'contact', 'wordiness-list', 'grammar-error-list',
	'transitions-list', 'database-add'
);
$page = 'default';
$data = array();
if (ANALYTICS != '') {
	$data['analytics'] = ANALYTICS;
}
if (isset($_GET['id']) && $_GET['id'] == 'start' ) {
  // A "start" callback wipes the session
	unset($_SESSION['text']);
}

// If text has just been submitted, place it in the session object
if (isset($_POST['text'])) { $_SESSION['text'] = $_POST['text'];}

if (isset($_GET['url']) && in_array($_GET['url'],$pages)) {
	// If the callback is for a page defined in the system
	$page = 'page';
	$data = array('content' => 'hello','sidebar' => 'mike');
	//$data = getContent('page',$_GET['url']);
}
elseif (isset($_SESSION['text'])) {
	// Some text has been submitted
	if (empty($_GET['id'])) {
		// No specific fix tab is selected
	  $page = 'results';
	  // $data = getContent('results',0);
	}
	else {
		// A specific fix tab is selected
		$page = 'fix';
		// $data = getContent('fix',$_GET['id'])
	}
}
echo $twig->render($page . '.twig', $data);
?>

