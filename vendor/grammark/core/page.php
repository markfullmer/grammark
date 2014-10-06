<?php

class Page {
  public function get($url = null) {
    $results = array('content' => $url, 'sidebar' => 'two');
    return $results;
  }
}
?>
