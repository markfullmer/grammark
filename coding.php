<?php
// Cleans text, finds word count, and splices the document into separate sentences
	$text = preg_replace('/[\.!?;]/', '.', $text); // Unify terminators
	$wordcount = str_word_count($text);
	if ($wordcount == 0) { die ('<h1>You need to enter some text to make this work. <a href="?id=start">Try again</a></h1>'); }
	// Puts each sentence into an array called $sentences
	$sentences = explode('.', $text);
	$sentencecount = count($sentences);
	$_SESSION['sentencecount'] = $sentencecount;
	// Strips all characters except alphabetical
	$text = ereg_replace("[^\'A-Za-z-]", " ", html_entity_decode($text, ENT_QUOTES));
	if ($sentencecount == 0) { die('<h1>You need to enter more than one sentence to make this work. <a href="?id=start">Try again</a></h1>'); }

// Find any run-on sentences, defined as having more than $runoncriteria words
	$runoncriteria = 50;
	$runons = array();
	foreach ($sentences as $sentence) {
		$sentencecounts[] = str_word_count($sentence);
		if (str_word_count($sentence) >= $runoncriteria) { 
			$runons[] = $sentence; 
			}
		}
	$runoncount = count($runons);
// Find any instances of 'And' 'But' 'Or'
			$count = 0;
			$count = $count+substr_count($text,'And');
			$count = $count+substr_count($text,'But');
			$count = $count+substr_count($text,'Or');
			$andbutorcount = $count;

// Standard deviation: takes average sentence length, finds each sentence's variance from this, then averages that deviation & converts it to a percent
	$wps = number_format($wordcount/$sentencecount);
	foreach ($sentencecounts as $sd) {
		$powers[] = pow($sd-$wps,2);
		}
		$standarddeviation = number_format(sqrt(array_sum($powers)/count($powers)));
	$sdpercent = number_format($standarddeviation/$wps*100);
	
// Find transitions
$transitions = array();
$sql = " SELECT DISTINCT transition FROM transitions ";
		$result = mysql_query($sql)	or die(mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{	extract($row); 
			$transitions[] = $transition;
		}	
$count = 0;
foreach ($transitions as $check) {
		$added = ' '. $check .' ';
		$pos = stripos($clean,$added);
		if(($pos !== false)) {	
			$ucheck = ucfirst($check);
			$uadded = ' '. $ucheck .' ';
			$count = $count+substr_count($clean,$added);
			$count = $count+substr_count($clean,$uadded);
			}
		}	
$transitionscount = $count;
if ($count > 0) { $transitionsper = number_format(($count/$sentencecount)*100); }
else { $transitionsper = 0; }

// Find wordiness
		$errors = array();
		$sql = " SELECT DISTINCT error FROM wordiness ";
		$result = mysql_query($sql)	or die(mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{	extract($row); 
			$errors[] = $error;
		}
$count = 0;
$wordymost = 0;
$errortype = array();
foreach ($errors as $check) {
		$added = ' '. $check .' ';
		$pos = stripos($clean,$added);
		if(($pos !== false)) {	
			$ucheck = ucfirst($check);
			$uadded = ' '. $ucheck .' ';
			$count = $count+substr_count($text,$added);
			$count = $count+substr_count($text,$uadded);
			if (substr_count($clean,$check) > $wordymost) { $wordymost = substr_count($clean,$added); $commonwordy = $check; }
			}
		}	
$wordycount = $count;

// Grammar Traps
		$errors = array();
		$sql = " SELECT DISTINCT error FROM miscellaneous ";
		$result = mysql_query($sql)	or die(mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{	extract($row); 
			$errors[] = $error;
		}
$count = 0;
$grammarmost = 0;
foreach ($errors as $check) {
		$added = ' '. $check .' ';
		$pos = stripos($clean,$added);
		if(($pos !== false)) {	
			$ucheck = ucfirst($check);
			$uadded = ' '. $ucheck .' ';
			$count = $count+substr_count($text,$added);
			$count = $count+substr_count($text,$uadded);
			if (substr_count($clean,$check) > $grammarmost) { $grammarmost = substr_count($clean,$added); $commongrammar = $check; }
			}
		}	

$grammarcount = $count;
// Passive voice
	$irregular = array("arisen","babysat","beaten","become","bent","begun","bet","bound","bitten","bled","blown","broken","bred","brought","broadcast","built","bought","caught","chosen","come","cost","cut","dealt","dug","done","drawn","drunk","driven","eaten","fallen","fed","felt","fought","found","flown","forbidden","forgotten","forgiven","frozen","gotten","given","gone","grown","hung","had","heard","hidden","hit","held","hurt","kept","known","lain","led","left","lent","let","lain","lit","lost","made","meant","met","paid","put","quit","read","ridden","rung","risen","run","said","seen","sold","sent","set","shaken","shone","shot","shown","shut","sung","sunk","sat","slept","slid","spoken","spent","spun","spread","stood","stolen","stuck","stung","struck","sworn","swept","swum","swung","taken","taught","torn","told","thought","thrown","understood","woken","worn","won","withdrawn","written","burned","burnt","dreamed","dreamt","learned","smelled","bet","broadcast","cut","hit","hurt","let","put","quit","read","set","shut","spread","awoken");
	$verbs = array('is','are','was','were','be','being','been','Is','Are','Was','Were','Be','Being','Been');
	$wordlist = explode(' ', $text);
	$gotverb = 0;
	$passive = array();
// Loop through the text, word by word
	foreach ($wordlist as $word) {
		$word = trim($word);
	// If the previous word was an 'is' 'has' or 'be' verb...
	if ($gotverb != '0') { 
		// If the current word is a past participle
		if (substr($word,-2) == 'ed' || in_array($word,$irregular)) { $passive[] = $gotverb. " ". $word;
		$pair = $gotverb. " ". $word;
		}
	}
	// Reset the checker
	$gotverb = '0';
	// Search for 'is' 'has' and 'be' verbs
	if (in_array($word,$verbs)) { 
	$gotverb = $word;}
	}
$passivecount = count($passive);

// Spelling check
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
 $spellingmost = 0;
	foreach ($errors as $check) {
		$added = ' '. $check. ' ';
		$pos = strpos($clean,$added);
		if(($pos !== false)) {	
			$count = $count+substr_count($clean,$added);
			if (substr_count($clean,$check) > $spellingmost) { $spellingmost = substr_count($clean,$added); $commonspelling = $check; }
			}
		}	
$spellinggrammar = $grammarcount;

// SCORING
// Assign the allowed threshold for scoring
	$allowedpassive = 10;
	$allowedwordiness = 5;
	$allowedgrammar = 0;
	$allowedtransitions = 25;
	$allowedandbutor = 5;
	$allowedvariety = 50;
	}

// Assumes no thresholds are passed, then checks if any are
$passivescore = 0;
$wordyscore = 0;
$grammarscore = 0;
$transitionsscore = 0;
$andbutorscore = 0;
$varietyscore = 0;

if((count($passive)/$sentencecount*100) > $allowedpassive) { $passivescore = number_format(count($passive)/$sentencecount*100)-$allowedpassive; }
if(($spellinggrammar/$sentencecount*100) > $allowedgrammar) { $grammarscore = number_format($spellinggrammar/$sentencecount*200)-$allowedgrammar; }
if(($wordycount/$sentencecount*100) > $allowedwordiness) { $wordyscore = number_format($wordycount/$sentencecount*150)-$allowedwordiness; }
if(($transitionscount/$sentencecount*100) < $allowedtransitions) { $transitionsscore = $allowedtransitions-number_format($transitionscount/$sentencecount*100); }
if(($andbutorcount/$sentencecount*100) > $allowedandbutor) { $andbutorscore = number_format($andbutorcount/$sentencecount*100)-$allowedandbutor; }
if($sdpercent < $allowedvariety) { $varietyscore = $allowedvariety-$sdpercent; }


$problems = $runoncount+$wordycount+$andbutorcount+$passivecount+$spellinggrammar;

$score = number_format(100-($passivescore+$wordyscore+$grammarscore+$transitionsscore+$andbutorscore+$varietyscore));
if ($score < 0) { $score = 0; }
?>