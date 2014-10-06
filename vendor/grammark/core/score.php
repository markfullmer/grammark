<?php

class Score {

  protected $default = array(
    'passive' => '10',
    'wordiness' => '5',
    'grammar' => '0',
    'transitions' => '25',
    'andbutor' => '15',
    'variety' => '50',
  );
  protected $humanities = array(
    'passive' => '10',
    'wordiness' => '5',
    'grammar' => '0',
    'transitions' => '25',
    'andbutor' => '15',
    'variety' => '50',
  );
  protected $sciences = array(
    'passive' => '40',
    'wordiness' => '10',
    'grammar' => '0',
    'transitions' => '25',
    'andbutor' => '0',
    'variety' => '40',
  );
  protected $internet = array(
    'passive' => '5',
    'wordiness' => '0',
    'grammar' => '0',
    'transitions' => '15',
    'andbutor' => '30',
    'variety' => '40',
  );

  public function __construct() {
    if (isset($_POST['customize'])) {
      $_SESSION['score'] = $_POST['score'];
    }
    elseif (isset($_GET['preset']) && $_GET['preset'] == 'sciences') {
      $_SESSION['score'] = $this->sciences;
    }
    elseif (isset($_GET['preset']) && $_GET['preset'] == 'humanities') {
      $_SESSION['score'] = $this->humanities;
    }
    elseif (isset($_GET['preset']) && $_GET['preset'] == 'internet') {
      $_SESSION['score'] = $this->internet;
    }
    else {
      $_SESSION['score'] = $this->default;
    }
  }
}
?>
