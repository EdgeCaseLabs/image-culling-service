<?php
/**
 * If you need cron jobs every X seconds
 * @author    http://blog.setcronjob.com/2010/06/if-you-need-cron-jobs-every-x-seconds.html
 */
  

// Cron settings

// Cron URL here.
$cron_url="http://localhost/cull-images.php";
// Time interval needed (second).
$time_interval=15;
// Real time interval (minute).
$real_time_interval=1;


set_time_limit(0);
ignore_user_abort(1);

$number_of_execution=floor($real_time_interval*60/$time_interval);
for($i=0; $i<$number_of_execution; $i++) {
  $time=microtime(1);
  file_get_contents($cron_url);
  $time=microtime(1)-$time;
  $i<$number_of_execution and sleep($time_interval-$time);
}


?>
Done