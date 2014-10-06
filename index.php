<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'settings.php';
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
'cache' => 'cache/compilation_cache',
));
//  add to above for caching: 'cache' => 'cache/compilation_cache',

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
$template = 'default';
$data = array();
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
	$data = $page->get($_GET['url']);
}
elseif (isset($_SESSION['text'])) { // Some text has been submitted
	$db = new PDO('mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8', USERNAME, PASSWORD);
	new Score(); // load the current scores
	$text = new ProcessText($_SESSION['text']);
	$text->stripPunctuation();
	if (empty($_GET['id'])) { // No specific fix tab is selected
	  $template = 'results';
	  $results = new Results();
	  $data = $results->get();
	}
	else { // A specific fix tab is selected
		$template = 'fix';
		$fix = new Fix();
		$fix->setDB($db);
		$fix->getTable($_GET['id']);
		$text->getSentences();
		$fix->highlight($text);
		$data = $fix->render($_GET['id']);
	}
}
$data['template'] = $template;
$data['analytics'] = ANALYTICS;
echo $twig->render($template . '.twig', $data);
if (TESTING_MODE) {
	include 'tests/index.php';
}
?>

