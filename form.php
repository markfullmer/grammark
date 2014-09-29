<?php
	echo '<div style="width:800px;display:block;float:left;margin-bottom:15px;">Teachers: improve this site by <a href="wordiness-list.php">adding student errors</a></div>';
	echo '<form action="index.php" method="post" style="display:block;float:left;">';	
	echo '<textarea class="textbox" style="height:442px;width:400px;vertical-align:top;" rows="3" cols="4" placeholder="Type or paste your writing here. It will not be stored or reused in any way." name="text">';
	echo '</textarea>';
	echo '<p><input type="hidden" name="got" value="1" /></p>';
	echo '<p><input class="btn" type="submit" name="submit" value="Submit" /></p>'; 
	
	echo '</form>';
	echo '<div class="box" style="display:block;float:left;margin-left:10px;margin-top:2px;width:300px;">';
	echo '<h2>Gram<mark>mark</mark> helps with:</h2>
			<ul style="list-style-type:square;">
			<li>Passive voice</li>
			<li>Wordiness</li>
			<li>Vague language</li>
			<li>Transitions</li>
			<li>Sentence variety</li>
			<li>Run-on sentences</li>
			<li>Ands, Buts, Ors</li>
			<li>Grammar traps</li>
			</ul>';
	echo '<img src="screenshot1.png" alt="Screenshot of Grammark highlighting" />';
		
	echo '<h2>Grammark does <mark>not</mark> fix:</h2>
			<ul style="list-style-type:square;">
			<li>Fragments/incomplete sentences</li>
			<li>Comma splices</li>
			<li>Tense shifts</li>
			<li>Subject-verb agreement</li>
			<li>Apostrophe errors</li>
			<li>Poor/idiotic ideas</li>
			</ul>';
	echo '<h2>Fully Customizable</h2>';
	echo '<img src="customize.png" alt="Screenshot of Customization" />';
	echo '</div>';
	echo '</div>';
?>