<?php 
foreach($GLOBALS as $key => $d)
  {
  echo $key ;//.' => '.json_encode($d);
  echo '<hr>';
}