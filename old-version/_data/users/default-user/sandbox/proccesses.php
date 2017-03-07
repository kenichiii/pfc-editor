<?php 


echo $r2 = exec('pstree',$res2);
echo '<h2>RESULTS pstree: '.count($res2).'</h2>';
foreach($res2 as $key2=>$cmd2)
  {
    echo $key2.' => '. $cmd2.'<hr>';
  }

echo '<br>';

echo $r3 = exec('ps aux',$res3);
echo '<h2>RESULTS ps aux: '.count($res3).'</h2>';
foreach($res3 as $key3=>$cmd3)
  {
    echo $key3.' => '.$cmd3.'<hr>';
  }

echo '<br>';

echo $r4 = exec('ps xuww',$res4);
echo '<h2>RESULTS ps xuww: '.count($res4).'</h2>';
foreach($res4 as $key4=>$cmd4)
  {
    echo $key4.' => '.$cmd4.'<hr>';
  }

echo '<br>';