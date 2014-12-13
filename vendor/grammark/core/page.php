<?php

class Page {

  public $content;

  public function __construct() {
    $specific = preg_replace("/[^A-Za-z0-9?!]/",'',$_GET['url']);
    if (method_exists('Page',$specific)) {
      $this->$specific();
    }
    else {
      $this->standard();
    }
  }

  public function spamcheck($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  public function databaseadd() {
    $form = new Form();
    $this->content['message'] = $form->response();
    $this->content['content'] = 'place form here';
    $this->content['sidebar'] = 'sidebar here';
  }

  public function contact() {
    if (isset($_REQUEST['email'])) {
      if ($this->spamcheck($_REQUEST['email']) == FALSE) {
        $response = '<span style="color:red;">You need to put a valid email address</a>';
      }
      elseif ($_REQUEST['cyborg'] != $_REQUEST['z']) {
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
      $this->content['content'] = '<div class="panel">' . $response .'</div>';
    }
    $name = '';
    $email = '';
    $message = '';
    if (isset($_REQUEST['name'])) { $name = $_REQUEST['name']; }
    if (isset($_REQUEST['email'])) { $email = $_REQUEST['email']; }
    if (isset($_REQUEST['message'])) { $message = $_REQUEST['message']; }
    $x = rand(5,15);
    $y = rand(5,15);
    $z = $x+$y;
    $spamcheck = $x .' + '. $y .' = ';
    $this->content['content'] .=
    t( '<form method="post" action="index.php?url=contact">
        <input name="name" type="text" placeholder="Name" value="%name" />
        <input name="email" type="text" placeholder="Email (for reply)" value="%email" />
        <textarea name="message" style="height:200px;" placeholder="Type your message here.">%message</textarea>
        <p>Prove you\'re not a spammy cyborg thingie:
        <input type="text" name="cyborg" placeholder="%spamcheck" style="width:50px;"></p>
        <input type="hidden" name="z" value="%z">
        <input class="button" type="submit" value="Email" />
        </form>
        </div>', array('%name' => $name, '%email' => $email, '%message' => $message, '%spamcheck' => $spamcheck, '%z' => $z)
    );
  }

  public function errorLinks() {
    $results = '<h2>Word Lists</h2>';
    $results .= '<h3>' . l('/transitions-list','Transitions') . '</h3>';
    $results .= '<h3>' . l('/grammar-error-list','Grammar Errors') . '</h3>';
    $results .= ' <h3>' . l('/wordiness-list','Wordiness List') . '</h3>';
    $results .= ' <h3>' . l('/spelling-errors','Common Spelling Errors') . '</h3>';
    $results .= ' <h3>' . l('/academic-style-list','Academic Style') . '</h3>';
    return $results;
  }

  public function transitionslist() {
    $data = new Data();
    $table = $data->getAllByTable('transitions');
    $content .= '<table>';
    foreach ($table as $key => $value) {
      $content .= '<tr><td>' . $value['transition'] . '</td></tr>';
    }
    $content .= '</table>';
    $this->content = array(
      'content' => $content,
      'sidebar' => $this->errorLinks(),
      'message' => 'Complete list of transitions, used by Grammark to evaluate
      the flow of writing.'
    );
  }

public function spellingerrors() {
    $data = new Data();
    $table = $data->getAllByTable('misspellings');
    $content = '<table><tr><th>Spelling Mistake</th><th>Correct Spelling</th></tr>';
    foreach ($table as $key => $value) {
      $content .= '<tr><td>' . $value['error'] . '</td><td> ' . $value['correct']. '</td></tr>';
    }
    $content .= '</table>';
    $this->content = array(
      'content' => $content,
      'sidebar' => $this->errorLinks(),
      'message' => 'Complete spelling errors checked by Grammark.'
    );
  }

  public function academicstylelist() {
    $data = new Data();
    $table = $data->getAllByTable('academic');
    $content .= '<table><tr><th>Informal / Casual</th><th>Academic Usage</th></tr>';
    foreach ($table as $key => $value) {
      $content .= '<tr><td>' . $value['error'] . '</td><td> ' . $value['suggestion']. '</td></tr>';
    }
    $content .= '</table>';
    $this->content = array(
      'content' => $content,
      'sidebar' => $this->errorLinks(),
      'message' => 'Complete list of academic style checked by Grammark.'
    );
  }

  public function grammarerrorlist() {
    $data = new Data();
    $table = $data->getAllByTable('miscellaneous');
    $content .= '<table><tr><th>Grammar Error</th><th>Suggested Fix</th></tr>';
    foreach ($table as $key => $value) {
      $content .= '<tr><td>' . $value['error'] . '</td><td> ' . $value['correct']. '</td></tr>';
    }
    $content .= '</table>';
    $this->content = array(
      'content' => $content,
      'sidebar' => $this->errorLinks(),
      'message' => 'Complete list of grammar errors checked by Grammark.'
    );
  }

  public function wordinesslist() {
    $data = new Data();
    $table = $data->getAllByTable('wordiness');
    $content = '<table><tr><th>Unnecessary Word(s)</th><th>Suggested Fix</th></tr>';
    foreach ($table as $key => $value) {
      $content .= '<tr><td>' . $value['error'] . '</td><td> ' . $value['correct']. '</td></tr>';
    }
    $content .= '</table>';
    $this->content = array(
      'content' => $content,
      'sidebar' => $this->errorLinks(),
      'message' => 'Complete list of words considered extraneous or unnecessary,
    with suggested fixes.'
    );
  }

  public function standard() {
    $data = new Data();
    $this->content = array(
      'content' => $data->getOneByURL($_GET['url']),
      'sidebar' => ''
    );
  }
}
?>
