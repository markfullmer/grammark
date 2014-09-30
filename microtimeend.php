<?php
$time_end = getmicrotime();
$time = $time_end - $time_start;
echo 'Results generated in '. number_format($time,2) .' seconds.';
?>
