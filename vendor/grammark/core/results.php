<?php

class Results {
  public function get() {
    $results = array('content' => $_SESSION['text'], 'sidebar' => 'two');
    return $results;
  }
}
?>
