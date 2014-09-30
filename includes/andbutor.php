<?php 
	$_SESSION['id'] = 'andbutor';
	$id = 0;
	$count = 0;
	
// Find any run-on sentences, defined as having more than $runoncriteria words
	$runoncriteria = 50;
	$runons = array();
	$unifysentence = preg_replace('/[\.!?;]/', '.', $text); // Unify terminators
	$sentences = explode('.', $unifysentence);
	foreach ($sentences as $sentence) {
		// $sentencecounts will later be used to find standard deviation
		$sentencecounts[] = str_word_count($sentence);
		if (str_word_count($sentence) >= $runoncriteria) { 
			$runons[] = $sentence; 
			$highlighted = '<span style="background-color:yellow;">'. $sentence .'</span><span style="color:blue;">[run-on sentence?]</span>' ;
			$text = str_replace($sentence,$highlighted,$text);
			}
		}
	$_SESSION['runoncount'] = count($runons);
	
// Highlight any instances of 'And' 'But' 'Or'
		$highlighted = '<span style="background-color:yellow">And</span>' ;
			$text = str_replace('And',$highlighted,$text);
			$count = $count+substr_count($text,'And');
		$highlighted = '<span style="background-color:yellow">But</span>' ;
			$text = str_replace('But',$highlighted,$text);
			$count = $count+substr_count($text,'But');
		$highlighted = '<span style="background-color:yellow">Or</span>' ;
			$text = str_replace('Or',$highlighted,$text);
			$count = $count+substr_count($text,'Or');
			$_SESSION['andbutorcount'] = $count;
			
// Standard deviation: takes average sentence length, finds each sentence's variance from this, then averages that deviation & converts it to a percent
	$wordcount = str_word_count($_SESSION['text']);
	$sentencecount = count($sentences);
	$wps = number_format($wordcount/$sentencecount);
	foreach ($sentencecounts as $sd) {
		$powers[] = pow($sd-$wps,2);
		}
		$standarddeviation = number_format(sqrt(array_sum($powers)/count($powers)));
	$_SESSION['sdpercent'] = number_format($standarddeviation/$wps*100);

// Output
echo '<div class="panel">'; 
echo '<br />';
if ($_SESSION['sdpercent'] <= 70 || $_SESSION['andbutorcount'] >= '1' || $_SESSION['runoncount'] >= '1') {
echo '<img src="img/fail.png" style="display:inline; float:right;" alt="failed the test" />';
echo '<p>Your sentences are <b>'. $wps .' words long</b> on average.';
if ($wps <= 15) { echo ' These are pretty short for formal, academic writing. Your writing will sound more sophisticated if you use longer sentences.'; }
if ($wps >= 30) { echo ' This is a little long and might make your ideas confusing. Try reducing the average sentence length.'; }
echo '</p><p>They have a sentence variety of <b>'. $_SESSION['sdpercent'] .'%</b> (the higher the percent, the more varied your sentences).';
echo ' Sentences that are the same length sound monotonous and dull.';
if ($_SESSION['sdpercent'] <= 70) { echo ' Try to raise this score to <b>above 70%</b> by making some sentences shorter and others longer.'; }
echo '</p><p>You have <b>'. $_SESSION['andbutorcount'];
if ($_SESSION['andbutorcount'] == '0' || $_SESSION['andbutorcount'] >= '2')  { echo ' sentences</b> that begin'; }
else { echo ' sentence</b> that begins'; }
echo ' with "And," "But," or "Or". For informal writing this is okay, but for formal writing,
these conjunctions should appear within sentences, not at the beginning. Try to eliminate this issue.</p>'; 
echo '<p> You have '. $_SESSION['runoncount'] .' potential run-on sentence';
if ($_SESSION['runoncount'] > '1') {echo 's. They probably should be shortened.'; }
if ($_SESSION['runoncount'] == '0') {echo 's. Nice work.'; }
echo '</p>';
}
else {
echo '<img src="img/pass.png" style="float:right;" alt="pass the test" /><p>Your writing has <b>';
echo $_SESSION['andbutorcount'];
echo ' sentence';
if ($_SESSION['andbutorcount'] == '0' || $_SESSION['andbutorcount'] >= '2') 
{ echo 's</b> that begin '; }
else 
{ echo '</b> that begins '; }
echo 'with "And," "But," or "Or." That is pretty good.</p>';
}
echo '</div>';

