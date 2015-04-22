<?php
/**
 * Class to retrieve data from static files in /grammark/core/data/
 */
class Data {

  protected static $table;

  public function getTable($obj) {
    $rows = array();
    $table = array();
    $file = __DIR__ . '/data/' . $obj::$table . '.inc';
    if(file_exists($file)) {
      include_once($file);
      $rows = ${$obj::$table};
      $inc = 0;
      foreach($rows as $row) {
        $table[$inc]['find'] = $row{$obj::$find};
        if (isset($obj::$suggestion)) {
          $table[$inc]['suggestion'] = $row{$obj::$suggestion};
        }
        $inc++;
      }
    }
    return $table;
  }

  public function getAllByTable($table) {
    $row = array();
    $file = __DIR__ . '/data/' . $table . '.inc';
    if(file_exists($file)) {
      include_once($file);
      $row = $$table;
    }
    return $row;
  }
}
