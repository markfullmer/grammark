<?php

class Score {
  public function __construct($config) {
    if (isset($_POST['customize'])) {
      $_SESSION['score']{$config::$name} = $_POST{$config::$id};
    }
    elseif (isset($config::${$_GET['preset']})) {
      $_SESSION['score']{$config::$name} = $config::${$_GET['preset']};
    }
    elseif (empty($_SESSION['score']{$config::$name})) {
      $_SESSION['score']{$config::$name} = $config::$standard;
    }
  }
}
?>
