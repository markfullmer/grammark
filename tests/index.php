<?php
include 'tests/texts.php';
echo '<h2>Automated tests</h2>';
$test = new RunTests();
echo $test->countTransitions($textone, 3);
echo $test->countSentences($textone,20);
/* Tests to implement
Calculate average sentence length
Calculate sentence variety (standard deviation)
Calculate passive voice instances
Calculate wordiness instances
Calculate grammar error instances
Calculate andbutor instances
Calculate run-on instances
*/

class RunTests {

  protected $message;
  protected $boolean;

  public function countTransitions($text,$count) {
    $this->message = 'Count the number of case-insensitive transitions in a text';
    $text = new ProcessText($text);
    $text->stripPunctuation();
    $fix = new Fix();
    $db = new PDO('mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8', USERNAME, PASSWORD);
    $fix->setDB($db);
    $fix->getTable('transitions');
    $text->getSentences();
    $fix->highlight($text);
    $results = $this->assertEqual($fix->count, $count);
    return $results;
  }

  public function countSentences($text,$count) {
    $this->message = 'Count the number of sentences in a text';
    $text = new ProcessText($text);
    $text->stripPunctuation();
    $text->getSentences();
    //print_r($text);
    $results = $this->assertEqual($text->sentences['count'], $count);
    return $results;
  }

  public function assertEqual($actual,$expected) {
    $this->boolean = ($actual === $expected) ? true : false;
    return $this->display();
  }

  public function display() {
    $result = $this->boolean ? 'Passed: ' : '<b>Failed</b>: ';
    return $result.$this->message.'<br />';
  }
}
?>
