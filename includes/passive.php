<?php

	$_SESSION['id'] = 'passive';

	$wordlist = explode(' ', $clean);

	$gotverb = 0;	

	$passive = array();

	$irregular = array("arisen","babysat","beaten","become","bent","begun","bet","bound","bitten","bled","blown","broken","bred","brought","broadcast","built","bought","caught","chosen","come","cost","cut","dealt","dug","done","drawn","drunk","driven","eaten","fallen","fed","felt","fought","found","flown","forbidden","forgotten","forgiven","frozen","gotten","given","gone","grown","hung","had","heard","hidden","hit","held","hurt","kept","known","lain","led","left","lent","let","lain","lit","lost","made","meant","met","paid","put","quit","read","ridden","rung","risen","run","said","seen","sold","sent","set","shaken","shone","shot","shown","shut","sung","sunk","sat","slept","slid","spoken","spent","spun","spread","stood","stolen","stuck","stung","struck","sworn","swept","swum","swung","taken","taught","torn","told","thought","thrown","understood","woken","worn","won","withdrawn","written","burned","burnt","dreamed","dreamt","learned","smelled","bet","broadcast","cut","hit","hurt","let","put","quit","read","set","shut","spread","awoken");

	$verbs = array('is','are','was','were','be','being','been', 'Is', 'Are', 'Was', 'Were', 'Be', 'Being', 'Been');

// Loop through the text, word by word

foreach ($wordlist as $word) 

{

	$word = trim($word);

	// If the previous word was an 'is' or 'be' verb...

	if ($gotverb != '0') 

	{ 

		// If the current word is a past participle

		if (substr($word,-2) == 'ed' || in_array($word,$irregular)) 

		{ 	$passive[] = $gotverb. " ". $word;

			$pair = $gotverb. " ". $word;

			$highlighted = '<span style="background-color:yellow;">'. $gotverb. ' '. $word .'</span>';

			// Highlight the text and add it to a list

			$text = str_replace($pair,$highlighted,$text);

		}

	}

	// Reset the checker

	$gotverb = '0';

	// Search for 'is' 'has' and 'be' verbs

	if (in_array($word,$verbs)) { $gotverb = $word;}

}



$passivecount = count($passive);

$passivepercent = number_format($passivecount/$sentencecount*100);

	

// Feedback

echo '<div class="panel">';

// Give the percent of passive voice sentences

if ($passivepercent >= $_SESSION['allowedpassive']) {

	echo '<img src="img/fail.png" style="display:inline; float:right;" alt="failed the test" /><p>Your writing has <b>';

	echo $passivepercent;

	echo '% passive voice</b> sentences. Generally, writing is clearer in active voice:<br /><ul style="list-style-type:none;"><li>

	Compare "Planet Mars was eaten by Mark." (passive) to "Mark ate Planet Mars." (active)</li></ul>

	What to do: think "who did what" structure, not "what was done by whom." You\'ll probably need to reverse the sentence order: (was eaten by Mark --> Mark ate). Basically, avoid <i>is, was, were</i> or <i>be,being been</i> + past tense verb. Example fixes:

	<ul>

	<li>it <span style="background-color:yellow;"><span style="text-decoration:line-through;">is</span> accept<span style="text-decoration:line-through;">ed</span></span> that... --> we <b>accept</b> that...</li>

	<li>needs to <span style="background-color:yellow;"><span style="text-decoration:line-through;">be</span> fund<span style="text-decoration:line-through;">ed</span></span> by X... --> X needs to <b>fund</b>...</li>

	<li>Y can <span style="background-color:yellow;"><span style="text-decoration:line-through;">be</span> taught</span> by X... --> X can <b>teach</b> Y...</li></ul>

	Try for <b>less than '. $_SESSION['allowedpassive'] .'%</b> passive sentences.</p>'; }

else {

	echo '<img src="img/pass.png" style="float:right;" alt="passed the test" /><p>Your writing has <b>';

	echo $passivepercent;

	echo '% passive voice</b> sentences. Congrats!</p>';

}

echo '</div>';

?>