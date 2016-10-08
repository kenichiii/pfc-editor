<?php 

//make tool as phpinfo

foreach($_SERVER as $key=>$value)
{
  echo $key .' => '.$value.'<hr>';  
}
