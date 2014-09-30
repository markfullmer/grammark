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
?>
<div>
<h4>Click on the text below to start editing</h4>
<div id="content" class="textbox" style="padding:10px 30px 10px 30px;" contenteditable="true"><?php echo stripslashes($text); ?></div>	
<form action="?id=<?php echo $id; ?>" method="post" onsubmit="return copyContent()">
	<p><textarea class="textbox" id="text" name="text" rows="50" cols="55" style="display:none; visibility:none" ></textarea></p>
	<p><input type="hidden" name="id" value="<?php echo $id; ?>" /></p>
	<p><input class="button" type="submit" name="submit" value="Recheck"/></p>
</form>
<form action="saveword.php" method="post" onsubmit="return copyContenttwo()">
	<p><textarea class="textbox" id="save" name="text" rows="50" cols="55" style="display:none; visibility:none" ></textarea></p>
	<p><input class="button" type="submit" name="submit" value="Save &amp; Download"/></p>
	</form>
	<?php include('microtimeend.php'); ?>
</div>
