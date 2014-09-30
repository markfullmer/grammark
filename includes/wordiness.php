<?php

$_SESSION['id'] = 'wordiness';

		$errors = array();

		$corrects = array();

		$associated = array();

	

		$sql = " SELECT id,error,correct FROM wordiness ";

		$result = mysql_query($sql)	or die(mysql_error());

		while ($row = mysql_fetch_array($result)) 

		{	extract($row); 

			$errors[] = $error;

			$corrects[] = $correct;

			$associated[$error] = $correct;

		}



// Find errors

$count = 0;

foreach ($errors as $check) {

		$added = ' '. $check .' ';

		$pos = stripos($clean,$added);

		if(($pos !== false)) {

		$ucheck = ucfirst($check);

		$highlighted = ' <ul class="help"><a class="help">'. $check . '<li class="help">['. $associated[$check] . '?]</li></a></ul> ' ;

		$uhighlighted = ' <ul class="help"><a class="help">'. $ucheck . '<li class="help">['. $associated[$check] . '?]</li></a></ul> ' ;

			$text = ereg_replace($check,$highlighted,$text);

			$text = ereg_replace($ucheck,$uhighlighted,$text);

			$count = $count+substr_count($clean,$check);

			$count = $count+substr_count($clean,$ucheck);

			}

		}	

$_SESSION['wordycount'] = $count;

echo '<div class="panel">'; 



if (($count/$sentencecount*100) > $_SESSION['allowedwordiness']) { echo '<img src="img/fail.png" alt="Failed the criteria" style="float:right;" />'; 

echo '<p>Your writing has <b>';

echo $_SESSION['wordycount'];

echo ' potential wordiness issues</b> from <a href="wordiness-list.php">this list</a>. Why use 3 words when you can say it with 1? Consider the following examples:

<ul>

<li>it seems <span style="background-color:yellow;">to be</span> effective --> it <b>seems</b> effective</li>

<li>the amount of energy <span style="background-color:yellow;">being</span> used --> the amount of energy used</li>

<li><span style="background-color:yellow;">each of us</span> can try --> <b>each</b> can try</li></ul>

Try to eliminate all wordiness.</p>'; }

else { echo '<img src="img/pass.png" alt="Passed the criteria" style="float:right;" /> Your writing has <b>'; 

echo $count;

echo '</b> potential wordiness issues</b>. You passed the criteria. Good work.</p>';

}

echo '</div>';

?>