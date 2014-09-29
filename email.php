<?php
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
  else
    {
    $email = $_REQUEST['email'] ;
    $subject = $_REQUEST['subject'] ;
    $message = $_REQUEST['message'] ;
    mail("mfullmer@gmail.com", "Subject: $subject",
    $message, "From: $email" );
    echo "Your email was sent. We'll get back to you soon.";
    }
  }

  echo "<form method='post' action='email.php'>
  <input name='name' type='text' class='textbox' placeholder='Name' />
  <input name='email' type='text' class='textbox' placeholder='Email (for reply)' />
  Subject: <input name='subject' type='text' /><br />
  Message:<br />
  <textarea name='message' rows='15' cols='40'>
  </textarea><br />
  <input type='submit' />
  </form>";
 
?>