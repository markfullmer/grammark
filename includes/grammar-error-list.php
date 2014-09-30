<div class="panel">Lists: <a href="wordiness-list">Wordiness</a> | <a href="grammar-error-list">Grammar</a> | <a href="transitions-list">Transitions</a></div>

<?php

include ('mysql.php');
$errortype = 'grammar';
echo '<div id="wrap"><h1>Grammar Error List</h1>';

echo '<table><tr><td><b>Error</b></td><td><b>Suggested Correction</b></td></tr>';

		$sql = " SELECT id,error,correct FROM miscellaneous ";

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