<?php session_start(); ?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-1' />
	<title>Grammar Checker and Writing Style </title>
	<meta name="Author" content="Mark Fullmer" />
	<meta name="Description" content="Open Source PHP Code for grammar checking" />
	<link rel="shortcut icon" href="favicon.ico">

<style type="text/css">
	<?php echo htmlentities(file_get_contents('style.css', true)); ?>
</style>
<?php
include('mysql.php');
if (empty($_GET['id'])) {$tab = 1;}
elseif ($_GET['id'] == 'passive') { $tab = 2; }
elseif ($_GET['id'] == 'wordiness') { $tab = 3; }
elseif ($_GET['id'] == 'transitions') { $tab = 4; }
elseif ($_GET['id'] == 'andbutor') { $tab = 5; }
elseif ($_GET['id'] == 'grammar') { $tab = 6; }
elseif ($_GET['id'] == 'specific') { $tab = 7; }
else {$tab = 1; }
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31166327-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<?php echo '<body id="tab'. $tab .'">'; 
?>
<div id='wrap'>
<div style="display:block;float:left;margin:0px;"><a href="index.php"><img src='title.png' alt='grammark, the writing aide' /></a></div>
<?php 
if (isset($_GET['id']) && $_GET['id'] == 'start' ) { $_SESSION['text'] = '0'; } 
echo '<div style="display:block;float:left;">';
// if (isset($_SESSION['text']) && $_SESSION['text'] != '0' || isset($_POST['text'])) { echo '<a href="index.php?id=start">Start Over</a> | '; } 
?>
<a href="about.php">About</a> | <a href="source-code.php">Source Code</a> | <a href="contact.php">Contact</a></div>