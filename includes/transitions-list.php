<div class="panel">Lists: <a href="wordiness-list">Wordiness</a> | <a href="grammar-error-list">Grammar</a> | <a href="transitions-list">Transitions</a></div>
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

		echo '</table>';

?>