<?php

class Form {

  public function emailcheck($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  public function spamcheck($expected,$actual) {
    if ($expected == $actual) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  public function response() {
    if (isset($_REQUEST['email'])) {
      if ($this->emailcheck($_REQUEST['email']) == FALSE) {
        $response = '<span style="color:red;">You need to put a valid email address</a>';
      }
      elseif ($this->spamcheck($_REQUEST['cyborg'],$_REQUEST['z'])) {
        $response = '<span style="color:red;">Your math is wrong. Either you are a spam bot or you need to go back to grade 1.</span>';
      }
      else {
        $email = htmlspecialchars($_REQUEST['email']);
        $name = htmlspecialchars($_REQUEST['name']);
        $message = htmlspecialchars($_REQUEST['message']);
        mail(EMAIL, "Grammark: $name",
        $message, "From: $email" );
        $response =  "Your email was sent. We'll get back to you soon.";
      }
    return $response;
    }
  }

}
?>
