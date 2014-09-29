<?php
	if (isset($_POST['text'])) 
		{ 
		$text = strip_tags($_POST['text'], '<p></p><br />');
		$text = preg_replace('/\[.*?\]/', '', $text);
		}
	else { $text = $_SESSION['text']; }
	$text = preg_replace('/[ ]+/', ' ', $text); // Remove multiple spaces
	$_SESSION['text'] = $text;
	$counting = preg_replace('/[\.!?;]/', '.', $text); // Unify terminators
	$sentences = explode('.', $counting);
	$sentencecount = count($sentences);
	$clean = ereg_replace("[^\'A-Za-z-]", " ", html_entity_decode($text, ENT_QUOTES));
?>
