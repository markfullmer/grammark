<?php

$_SESSION['id'] = 'transitions';

$transitions = array();

		$sql = " SELECT DISTINCT transition FROM transitions ";

		$result = mysql_query($sql)	or die(mysql_error());

		while ($row = mysql_fetch_array($result)) 

		{	extract($row); 

			$transitions[]=trim($transition);

		}

// Find transitions

$count = 0;



foreach ($transitions as $check) {

		$added = ' '. $check .' ';

		$pos = stripos($clean,$added);

		if(($pos !== false)) {	

			$ucheck = ucfirst($check);

			$highlighted = '<span style="background-color:yellow">'. $check . '</span>' ;

			$uhighlighted = '<span style="background-color:yellow">'. $ucheck . '</span>' ;

			$text = ereg_replace($check,$highlighted,$text);

			$text = ereg_replace($ucheck,$uhighlighted,$text);

			$count = $count+substr_count($clean,$check);

			$count = $count+substr_count($clean,$ucheck);

			}

		}	



echo '<div class="panel">';

if (($count/$sentencecount*100) < $_SESSION['allowedtransitions']) { echo '<img src="img/fail.png" alt="Failed the criteria" style="float:right;" />'; }

else { echo '<img src="img/pass.png" alt="Passed the criteria" style="float:right;" />'; }

echo '<p>Gram<mark>mark</mark> checked your document to see how many transitions from <a href="transitions-list.php">this list</a> were present. Approximately <b>'. number_format(($count/$sentencecount)*100) .'%</b> of your sentences have transitions. Transitions help readers see your organization and thought process. Example:</p>

<ul><li><b>No transition:</b> <i>Martinez states that 70% of taxes are paid by the wealthiest 10%. Obama\'s argument about tax brackets seems...</i></li>

<li><b>Has transition:</b> <i>Martinez states that 70% of taxes are paid by the wealthiest 10%. <mark>Given this</mark> statistic, Obama\'s argument about tax brackets seems...</i></li>

</ul><p>';

if (($count/$sentencecount*100) < $_SESSION['allowedtransitions']) { echo 'Try to increase your transitions percentage to <b>'. $_SESSION['allowedtransitions'] .'%</b>.'; }

echo '</div>';

?>