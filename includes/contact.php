<div class="large-6 columns">
<?php 

function spamcheck($field) {
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);
  if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
    return TRUE;
    }
  else {
    return FALSE;
  }

}
if (isset($_REQUEST['email'])) {
  $mailcheck = spamcheck($_REQUEST['email']);
  if ($mailcheck == FALSE) {
    $response = '<span style="color:red;">You need to put a valid email address</a>';
  }
  elseif ($_REQUEST['cyborg'] != $_REQUEST['z']) {
    $response = '<span style="color:red;">Your math is wrong. Either you are a spam bot or you need to go back to grade 1.</span>';
  }
  else {
    $email = $_REQUEST['email'] ;
    $name = $_REQUEST['name'] ;
    $message = $_REQUEST['message'] ;
    mail("mfullmer@gmail.com", "Grammark: $name",
    $message, "From: $email" );
    $response =  "Your email was sent. We'll get back to you soon.";
    }
    echo '<div class="panel">' . $response .'</div>';
  }
?>

<form method='post' action='contact'>
  <input name='name' type='text' placeholder='Name' 
    <?php if (isset($_REQUEST['name'])) { echo 'value="'. $_REQUEST['name'] .'"'; } ?>
  />
  <input name='email' type='text' placeholder='Email (for reply)' 
    <?php if (isset($_REQUEST['email'])) { echo 'value="'. $_REQUEST['email'] .'"'; } ?>
  />
  <textarea name='message' style="height:200px;" placeholder='Type your message here.'><?php if (isset($_REQUEST['message'])) { 
    echo $_REQUEST['message']; } 
  ?></textarea>
  <?php
	 $x = rand(5,15);
	 $y = rand(5,15);
	 $z = $x+$y;
	?>
  <p>Prove you're not a spammy cyborg thingie:
  <input type="text" name="cyborg" placeholder="<?php echo $x .'+'. $y .'='; ?>" style='width:50px;'></p>
  <input type='hidden' name='z' value='<?php echo $z; ?>'>
  <input class='button' type='submit' value='Email' />
</form>
</div>




