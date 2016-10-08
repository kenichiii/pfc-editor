<?php 

 require_once 'test_webterminal/process.class.php';

 
 $p = new Process("su neco");

usleep(500000);
 $p->put("neco");
 $p->put(chr(13));
echo $p->get();
echo '<hr>';
//$p->put(chr(21));
//var_dump($p->close());
//echo json_encode($p->getStatus());
//echo '<hr>';
// $p->put("whoami");
// $p->put(chr(13));
//echo $p->get();
  usleep(500000);
 echo $p->get();
 $p->put("whoami");
 $p->put(chr(13));
echo $p->get();
echo '<hr>';
usleep(500000);
 echo $p->get();
echo '<hr>';
echo json_encode($p->getStatus());
echo '<hr>';
 $p->put("ls -l");
 $p->put(chr(13));
echo $p->get();
echo '<hr>';
usleep(500000);
 echo $p->get();
echo '<hr>';
usleep(500000);
 echo $p->get();
echo '<hr>';
echo "END ".($p->close() ? 'NOT VALID USER OR PASSWORD' : 'SUCC LOG IN');

