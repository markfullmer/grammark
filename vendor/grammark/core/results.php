<?php

class Results {

  public $tests;

  public function __construct($tabs) {
      foreach ($tabs as $class) {
          $obj = new $class($_SESSION['text']);
          new Score($obj);
          $database = new Data();
          $table = $database->getTable($obj);
          $obj->score($table);
          $obj->guidance();
          $checks[] = $obj;
      }
      $this->tests = $checks;
  }
  public function display() {
    foreach ($this->tests as $test) {
      $results['individual'][$test::$name] = array(
        'id' => $test::$id,
        'result' => $test->guidance['result'],
        'goal' => $test->guidance['goal'],
        'score' => $test->score,
        'type' => $test::$score_type,
        'raw_score' => $test->raw_score
      );
      if ($test::$fails_if == '>') {
        $results['total'] = $results['total']+$test->raw_score;
      }
    }
    return $results;
  }
}
?>
