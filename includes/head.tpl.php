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
  <title>Grammar Checker and Writing Style</title>
  <meta name="Author" content="Mark Fullmer" />
  <meta name="Description" content="Open Source PHP Code for grammar checking" />
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/foundation/5.4.4/css/foundation.min.css">  
<?php
include_once("js/analyticstracking.php")
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

</head>