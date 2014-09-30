<?php
include ('mysql.php');
$errortype = 'wordiness';
?>
<div class="panel">Lists: <a href="wordiness-list">Wordiness</a> | <a href="grammar-error-list">Grammar</a> | <a href="transitions-list">Transitions</a></div>

<h1>Wordiness List</h1>

<table><tr><td><b>Error</b></td><td><b>Suggested Correction</b></td></tr>

<?php

		$sql = " SELECT id,error,correct FROM wordiness ";
		$result = mysql_query($sql)	or die(mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{	extract($row); 
			echo '<tr><td>';
			echo $error;
			echo '</td><td>';
			echo $correct;
			echo '</td></tr>';
		}
		echo '</table>';

?>