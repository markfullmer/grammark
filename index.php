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
	$text = new ProcessText($_SESSION['text']);
	if (empty($_GET['id'])) { // No specific fix tab is selected
	  $template = 'results';
	  $results = new Results();
	  $content = $results->get();
	}
	else { // A specific fix tab is selected
		$template = 'fix';
		$type = new $_GET['id']();
		$config = get_class_vars(get_class($type));
		new Score($config); // load the current scores
		$database = new Data();
		$table = $database->getTable($config);
		//$content['guidance'] $text->calculate($configuration,$table)
		$text->getSentences();
		$text->sentenceVariety();
		echo $text->sentences['variety'];
		$content['output'] = $text->highlight($config,$table);
	}
}
$content['template'] = $template;
$content['analytics'] = ANALYTICS;
if (TESTING_MODE) {
	include 'tests/index.php';
}
//print_r($text);
echo $twig->render($template . '.twig', $content);
?>
