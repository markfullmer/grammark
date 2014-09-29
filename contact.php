<?php 
include ('header.php');
echo '<div style="width:800px;display:block;float:left;">';
if (isset($_GET['id']) && $_GET['id'] == 'start') { $_SESSION['text'] = '0';}
if (isset($_POST['text'])) { $_SESSION['text'] = $_POST['text'];}
if (isset($_SESSION['text']) && $_SESSION['text'] != '0')  {
	include ('menu.php');
	}

function spamcheck($field)
  {
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);
  if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
    return TRUE;
    }
  else
    {
    return FALSE;
    }
  }
if (isset($_REQUEST['email'])) {
  $mailcheck = spamcheck($_REQUEST['email']);
  if ($mailcheck==FALSE)
    {
    echo '<span style="color:red;">You need to put a valid email address</a>';
    }
  elseif ($_REQUEST['cyborg'] != $_REQUEST['z'])
    {
    echo '<span style="color:red;">Your math is wrong. Either you are a spam bot or you need to go back to grade 1.</span>';
    }
  else
    {
    $email = $_REQUEST['email'] ;
    $name = $_REQUEST['name'] ;
    $message = $_REQUEST['message'] ;
    mail("mfullmer@gmail.com", "Grammark: $name",
    $message, "From: $email" );
    echo "Your email was sent. We'll get back to you soon.";
    }
  }
?>
  <form method='post' action='contact.php'>
  <input name='name' type='text' class='textbox' style='width:200px;margin-top:10px;' placeholder='Name' 
  <?php if (isset($_REQUEST['name'])) { echo 'value="'. $_REQUEST['name'] .'"'; } ?>
  />
  <input name='email' type='text' class='textbox' style='width:200px;margin-top:10px;' placeholder='Email (for reply)' 
  <?php if (isset($_REQUEST['email'])) { echo 'value="'. $_REQUEST['email'] .'"'; } ?>
  />
  <textarea name='message' rows='15' cols='40' style='width:600px;height:200px;margin-top:10px;' class='textbox' placeholder='Type your message here.'><?php if (isset($_REQUEST['message'])) { echo $_REQUEST['message']; } ?></textarea>
  <?php
	$x = rand(5,15);
	$y = rand(5,15);
	$z = $x+$y;
	?>
  <p>Prove you're not a spammy cyborg thingie:
  <input type="text" class="textbox" name="cyborg" placeholder="<?php echo $x .'+'. $y .'='; ?>" style='width:50px;'></p>
  <input type='hidden' name='z' value='<?php echo $z; ?>'>
  <input class='btn' type='submit' value='Email' />
  </form>
</div>
<?php
include ('footer.php');
?>

