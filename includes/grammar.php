<?php

$_SESSION['id'] = 'grammar';

		$errors = array();

		$corrects = array();

		$associated = array();

		$sql = " SELECT id,error,correct FROM miscellaneous ";

		$result = mysql_query($sql)	or die(mysql_error());

		while ($row = mysql_fetch_array($result)) 

		{	extract($row); 

			$errors[] = $error;

			$corrects[] = $correct;

			$associated[$error] = $correct;

		}



// Find grammar errors

$count = 0;

foreach ($errors as $check) {

		$added = ' '. $check .' ';

		$pos = stripos($clean,$added);

		if(($pos !== false)) {

		$ucheck = ucfirst($check);

		$highlighted = ' <ul class="help"><a>'. $check . '<li>['. $associated[$check] . '?]</li></a></ul> ' ;

		$uhighlighted = ' <ul class="help"><a>'. $ucheck . '<li>['. $associated[$check] . '?]</li></a></ul> ' ;

			$text = ereg_replace($check,$highlighted,$text);

			$text = ereg_replace($ucheck,$uhighlighted,$text);

			$count = $count+substr_count($clean,$check);

			$count = $count+substr_count($clean,$ucheck);

			}

		}

$_SESSION['grammarcount'] = $count;



// Find spelling errors

	$errors = array();

	$corrects = array();

	$associated = array();

$sql = " SELECT id,error,correct FROM misspellings ";

		$result = mysql_query($sql)	or die(mysql_error());

		while ($row = mysql_fetch_array($result)) 

		{	extract($row); 

			$errors[] = $error;

			$corrects[] = $correct;

			$associated[$error] = $correct;

		}

$count = 0;

foreach ($errors as $check) {

		$added = ' '. $check .' ';

		$pos = stripos($clean,$added);

		if(($pos !== false)) {

		$ucheck = ucfirst($check);

		$uadded = ' '. $ucheck .' ';

		$highlighted = ' <ul class="help"><a>'. $check . '<li>['. $associated[$check] . '?]</li></a></ul> ' ;

		$uhighlighted = ' <ul class="help"><a>'. $ucheck . '<li>['. $associated[$check] . '?]</li></a></ul> ' ;

			$text = ereg_replace($check,$highlighted,$text);

			$text = ereg_replace($ucheck,$uhighlighted,$text);

			$count = $count+substr_count($clean,$added);

			$count = $count+substr_count($clean,$uadded);

			}

		}

$_SESSION['spellcount'] = $count;			

			

$gramspellcount = $count+$_SESSION['grammarcount'];		

// Analysis			

echo '<div class="panel">'; 

echo '<br />';

if ($count >= 1) {

	echo '<img src="img/fail.png" style="display:inline; float:right;" alt="failed the test" /><p>Your writing has <b>';

	echo $gramspellcount;

	echo ' grammar or spelling issues</b> from <a href="grammar-error-list.php">this list</a>. This doesn\'t mean those are all the errors. It\'s very difficult for computers to understand the nuances of natural language, and Gram<mark>mark</mark> cannot find things like sentence fragments, comma splices, subject-verb errors, pronoun agreement problems, and many other things.</p>'; }

else { echo '<img src="img/pass.png" style="float:right;" alt="pass the test" /><p>Gram<mark>mark</mark> marked <b>0 grammar or spelling issues</b>. This doesn\'t mean your writing is perfect. Even now, it\'s very difficult for computers to understand the nuances of natural language, and Gram<mark>mark</mark> cannot find things like sentence fragments, comma splices, subject-verb errors, pronoun agreement problems, and many other things.</p>'; }

echo '</div>';

?>