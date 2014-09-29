<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-1' />
	<meta http-equiv="Content-Language" content="en-us" />
	<title>Complete List of Transitions </title>
	<meta name="Author" content="Mark Fullmer" />
	<meta name="Description" content="List of Transitions" />
	</head>
	<body>
<?php
include ('mysql.php');
echo '<h1>Transitions List</h1>';
echo '<table>';
		$sql = " SELECT transition FROM transitions ";
		$result = mysql_query($sql)	or die(mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{	extract($row); 
			echo '<tr><td>';
			echo $transition;
			echo '</td></tr>';
		}
		echo '</table></body></html>';
?>