<?php 



include('calculations.php');	

// Potential problems

echo '<div class="large-6 columns"">';
echo '<h2>Potential Problems: <span style="background-color:yellow;">'. $problems .'</span></h2>';
echo '<table>';
echo '<tr><td>Words: </td><td>'. number_format($wordcount) .'</td></tr>';
echo '<tr><td>Sentences: </td><td>'. $sentencecount .'<br />';
echo '<tr><td>Words per sentence: </td><td>'. number_format($wordcount/$sentencecount);
if (($wordcount/$sentencecount) < 15 ) { echo ' <span class="error">(too simple)</span>'; }
if (($wordcount/$sentencecount) > 25 ) { echo ' <span class="error">(too complex)</span>'; }
echo '</td></tr>';

echo '<tr><td>Run-on sentences: </td><td>';
if ($runoncount > 0 ) { echo '<a class="error" href="?id=andbutor">'. $runoncount .'</a>'; }
else { echo '0'; }
echo '</td></tr>';

echo '<tr><td>And/But/Or starting a sentence: </td><td><a ';
if  (($andbutorcount/$sentencecount*100) > $_SESSION['allowedandbutor']) { echo 'class="error"'; }
echo 'href="?id=andbutor">'. $andbutorcount. ' ('. number_format(($andbutorcount/$sentencecount)*100) .'% of sentences)</a></td></tr>'; 

echo '<tr><td>Sentence variety: </td><td><a ';
if  ($sdpercent < $_SESSION['allowedvariety']) { echo 'class="error" '; }
echo 'href="?id=andbutor">'. $sdpercent .'%';
if  ($sdpercent < $_SESSION['allowedvariety']) { echo ' (too monotonous)'; } 
echo '</a></td></tr>';

echo '<tr><td>Transitions: </td><td><a ';
if  ($transitionsper < $_SESSION['allowedtransitions']) { echo 'class="error" '; }
echo 'href="?id=transitions">'. $transitionscount .' ('. $transitionsper .'% of sentences)</a></td></tr>';

echo '<tr><td>Wordiness: </td><td>';
if ($wordycount > 0 ) { echo '<a class="error" href="?id=wordiness">'. $wordycount .'</a>'; }
else { echo '0'; }
if (isset($commonwordy)) { echo ' (most common: <i>'. $commonwordy.'</i>)'; }
echo '</td></tr>';

echo '<tr><td>Grammar: </td><td>';
if ($spellinggrammar > 0 ) { echo '<a class="error" href="?id=grammar">'. $spellinggrammar .'</a>'; }
else { echo '0'; }
if ($grammarcount > 0) { echo ' (most common: <i>'. $commongrammar.'</i>)'; }
echo '</td></tr>';

echo '<tr><td>Passive voice: </td><td><a ';
if ((count($passive)/$sentencecount*100) > $_SESSION['allowedpassive']) 
	{ echo 'class="error" '; }
echo 'href="?id=passive">'. count($passive) .' ('. number_format(count($passive)/$sentencecount*100) .'% of sentences)</a>';
echo '</td></tr>';

echo '</table>';

echo '<a class="button" href="index.php?id=passive">Fix Problems</a> ';

echo '<a class="button" href="index.php?id=start">Start Over</a><br />';

include('microtimeend.php');

echo '</div>';



// Score

?>

<script type="text/javascript">

function showValue(value, name)

{

	document.getElementById(name).innerHTML=value;

}

</script>

<script src="html5slider.js"></script>

<div class="large-6 columns">
	<div class="panel">
<h2>Score: <?php echo $score; ?>%</h2>
<p>Calculates errors divided by number of your sentences (<?php echo number_format($sentencecount); ?> sentences). Maximum allowable errors for 100%:

<form action="index.php" method="post">	
	<span id="passive" style="font-weight:bold;"><?php echo $allowedpassive; ?></span>% passive sentences<br />
	<input type="range" name="allowedpassive" min="0" max="100" value="<?php echo $allowedpassive; ?>" step="1" onchange="showValue(this.value, 'passive')" /><br />
	<span id="wordiness" style="font-weight:bold;"><?php echo $allowedwordiness; ?>%</span> wordiness issues<br />
	<input type="range" name="allowedwordiness" min="0" max="100" value="<?php echo $allowedwordiness; ?>" step="1" onchange="showValue(this.value, 'wordiness')" /><br />
	<span id="grammar" style="font-weight:bold;"><?php echo $allowedgrammar; ?>%</span> grammar mistakes<br />
	<input type="range" name="allowedgrammar" min="0" max="100" value="<?php echo $allowedgrammar; ?>" step="1" onchange="showValue(this.value, 'grammar')" /><br />
	<span id="andbutor" style="font-weight:bold;"><?php echo $allowedandbutor; ?>%</span> And/But/Or sentences<br />
	<input type="range" name="allowedandbutor" min="0" max="100" value="<?php echo $allowedandbutor; ?>" step="1" onchange="showValue(this.value, 'andbutor')" /><br />
	<span id="transitions" style="font-weight:bold;"><?php echo $allowedtransitions; ?>%</span> sentences with transitions<br />
	<input type="range" name="allowedtransitions" min="0" max="100" value="<?php echo $allowedtransitions; ?>" step="1" onchange="showValue(this.value, 'transitions')" /><br />
	Better than <span id="variety" style="font-weight:bold;"><?php echo $allowedvariety; ?></span>% sentence variety<br />
	<input type="range" name="allowedvariety" min="0" max="100" value="<?php echo $allowedvariety; ?>" step="1" onchange="showValue(this.value, 'variety')" /><br />
	<input class="button" type="submit" name="customize" value="Customize" /> 
</form>

<p>

Presets: <a class="tiny button" href="index.php?preset=humanities">Humanities</a> 
<a class="tiny button" href="index.php?preset=sciences">Sciences</a> 
<a class="tiny button" href="index.php?preset=internet">Web</a> 
<a class="tiny button" href="index.php?preset=default">Default</a></p>
	</div>
</div>

