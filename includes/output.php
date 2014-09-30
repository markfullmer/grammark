<script type="text/javascript">
function copyContent () {
 document.getElementById("text").value =  
      document.getElementById("content").innerHTML;
 return true;
 }
 function copyContenttwo () {
 document.getElementById("save").value =  
      document.getElementById("content").innerHTML;
 return true;
 }
</script>
<?php
$text = nl2br($text);
$id = $_SESSION['id'];
// Output the text, highlighting stuff
	echo '<div>';
	echo '<h4>Click on the text below to start editing</h4>';
	echo '<div id="content" class="textbox" style="width:750px;padding:10px 30px 10px 30px;" contenteditable="true">'. stripslashes($text) .'</div>';	
	echo '<form action="?id='. $id .'" method="post" onsubmit="return copyContent()">';	
	echo '<p><textarea class="textbox" id="text" name="text" rows="50" cols="55" style="display:none; visibility:none" ></textarea></p>';
	echo '<p><input type="hidden" name="id" value="'. $id .'" /></p>';
	echo '<p><input class="button" type="submit" name="submit" value="Recheck"/></p>'; 
	echo '</form>';
	echo '<form action="saveword.php" method="post" onsubmit="return copyContenttwo()">';	
	echo '<p><textarea class="textbox" id="save" name="text" rows="50" cols="55" style="display:none; visibility:none" ></textarea></p>';
	echo '<p><input class="button" type="submit" name="submit" value="Save &amp; Download"/></p>'; 
	echo '</form>';
	include('microtimeend.php');
	echo '</div>';
?>