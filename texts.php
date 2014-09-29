<?php 
include ('header.php');
echo '<div style="width:900px;display:block;float:left;">';
if (isset($_GET['id']) && $_GET['id'] == 'start') { $_SESSION['text'] = '0';}
if (isset($_POST['text'])) { $_SESSION['text'] = $_POST['text'];}
if (isset($_SESSION['text']) && $_SESSION['text'] != '0')  {
	include ('menu.php');
	}

if ($_SESSION['logged'] == '1') 
{
echo '<div style="display:block;float:left;">';
if (isset($_POST['submit']))
	{
	$text = $_POST['text'];
	$raw = addslashes($_POST['text']);
	$clean = ereg_replace("[^\'A-Za-z-]", " ", html_entity_decode($text, ENT_QUOTES));
	include('calculations.php');
	$title = addslashes($_POST['title']);
	$author = addslashes($_POST['author']);
	$genre = $_POST['genre'];
	mysql_query("INSERT INTO texts (title,author,genre,text,wordcount,sentencecount,andbutorcount,wordycount,grammarcount,runoncount,transitionscount,sdpercent,passivecount) VALUES ('$title', '$author', '$genre', '$raw','$wordcount','$sentencecount','$andbutorcount','$wordycount','$grammarcount','$runoncount','$transitionscount','$sdpercent','$passivecount') ") 
		or die(mysql_error()); 
	}
elseif (isset($_GET['text'])) 
	{ 
		$id = $_GET['text'];
		$sql = " SELECT * FROM texts WHERE id = $id ";
		$result = mysql_query($sql)	or die(mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{	extract($row);
			
			echo $title;
			echo '<br />';
			echo $genre;
			echo '<br />';
			echo $text;
		}	
	}
else 
	{
		echo '<table><tr><td>Title</td><td>Genre</td><td>Words</td><td>WPSentence</td><td>Passive</td><td>Grammar</td><td>Wordiness</td><td>Transitions</td><td>Variety</td><td></tr>';
		$sql = " SELECT * FROM texts ORDER BY genre";
		$result = mysql_query($sql)	or die(mysql_error());
		while ($row = mysql_fetch_array($result)) 
		{	extract($row);
			echo '<tr><td><a href="?text=';
			echo $id;
			echo '">';
			echo $title;
			echo '</a></td><td>';
			echo $genre;
			echo '</td><td>';
			echo $wordcount;
			echo '</td><td>';
			echo number_format($wordcount/$sentencecount);
			echo '</td><td>';
			echo number_format(($passivecount/$sentencecount)*100);
			echo '</td><td>';
			echo number_format(($grammarcount/$sentencecount)*100);
			echo '</td><td>';
			echo number_format(($wordycount/$sentencecount)*100);
			echo '</td><td>';
			echo number_format(($transitionscount/$sentencecount)*100);
			echo '</td><td>';
			echo $sdpercent;
			echo '</td></tr>';
		}	
		echo '</table>';
		echo '<h2>Add a text</h2>';
		echo '<form method="post" action="texts.php">';
		echo '<input name="title" type="text" class="textbox" style="width:300px;height:10px;margin-top:10px;" placeholder="Title" />';
		echo '<input name="author" type="text" class="textbox" style="width:300px;height:10px;margin-top:10px;" placeholder="Author" />';
		echo '<input name="genre" type="text" class="textbox" style="width:300px;height:10px;margin-top:10px;" placeholder="Genre" />';
		echo '<textarea name="text" rows="15" cols="40" style="width:600px;height:200px;margin-top:10px;" class="textbox" placeholder="Paste text here" /></textarea>';
		echo '<input class="btn" type="submit" name="submit" value="Submit" /></form>';
	}
echo '</div>';
}
include ('footer.php');
?>

