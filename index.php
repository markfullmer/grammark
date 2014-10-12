<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'settings.php';
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
));
//  add to above for caching: 'cache' => 'cache/compilation_cache',

// Define some shared functions -- move to include if it gets too big
function t($string,$replacements) {
	foreach ($replacements as $find => $replace) {
		$string = str_replace($find,$replace,$string);
	}
	return $string;
}
// Define our custom autoloader
spl_autoload_register('my_autoloader');
define('DOCROOT', dirname(__FILE__));
function my_autoloader($name) {
		include DOCROOT . '/vendor/grammark/core/' . strtolower($name) . '.php';
}

$pages = array(
	'about', 'source', 'contact', 'wordiness-list', 'grammar-error-list',
	'transitions-list', 'database-add'
);
$tabs = array('passive','wordiness','transitions','grammar','andbutor');
$template = 'default';
$content = array();
if (isset($_GET['id']) && $_GET['id'] == 'start' ) {
  // A "start" callback wipes the session
	unset($_SESSION['text']);
}
// If text has just been submitted, store it in the session object
if (isset($_POST['text'])) { $_SESSION['text'] = $_POST['text'];}

if (isset($_GET['url']) && in_array($_GET['url'],$pages)) {
	// If the callback is for a page defined in the system
	$template = 'page';
	$page = new Page();
	$content = $page->get($_GET['url']);
}
elseif (isset($_SESSION['text'])) { // Some text has been submitted
	if (isset($_GET['id'])) { // A specific fix tab is selected
		if (in_array($_GET['id'],$tabs)) {
			$template = 'fix';
			$obj = new $_GET['id']($_SESSION['text']);
			unset($_SESSION['score']);
			new Score($obj);
			$database = new Data();
			$table = $database->getTable($obj);
			$obj->score($table);
			$content = $obj->guidance();
			$obj->highlight($table);
			$content['output'] = nl2br($obj->highlighted);
			$content['id'] = $_GET['id'];
			$content['guidance'] = $obj->guidance;
		}
		else {
			//redirect to base url?
			echo 'no good';
		}
	}
	if (empty($_GET['id'])) { // No specific fix tab is selected
	  $template = 'results';
	  unset($_SESSION['score']);
	  $results = new Results($tabs);
	  $content['results'] = $results->display();
	}

}
$content['template'] = $template;
$content['analytics'] = ANALYTICS;
if (TESTING_MODE) {
	include 'tests/index.php';
}
echo $twig->render($template . '.twig', $content);
?>
