<?php


//http://www.tecmint.com/15-basic-ls-command-examples-in-linux/
echo posix_getuid()."<hr>"; //10001
echo posix_geteuid()."<hr>"; //10001

$processUser = posix_getpwuid(posix_geteuid());
print $processUser['name'];
echo '<hr>';


$username = getenv('USERNAME') ?: getenv('USER');
echo $username; // e.g. root or www-data
echo '<hr>';



$response = exec('ls -lhaxoRi '.\PFC\Editor\PUBLIC_PATH.'',$r);
echo '<h2>founded: '.count($r).' results in '.\PFC\Editor\PUBLIC_PATH.'</h2>';
foreach($r as $key=>$match) 
  {
                    //change to mb_
    echo $key.' => '. $match . '<hr>';
    if($key>2500) {
      echo '<h2>END FIRST 2500 FINDED RESULTS -> CLICK HERE TO LOAD MORE/NEXT 2500</h2>';
      break;
    }
  }






$response2 = exec('ls -laxoRniF '.\PFC\Editor\LIBRARY_PATH,$r2);
echo '<h2>founded: '.count($r2).' results in '.\PFC\Editor\LIBRARY_PATH.'</h2>';
foreach($r2 as $key2=>$match2) 
  {
                    //change to mb_
    echo $key2.' => '. $match2 . '<hr>';
    if($key2>200) {
      echo '<h2>END FIRST 200 FINDED RESULTS -> CLICK HERE TO LOAD MORE/NEXT 200</h2>';
      break;
    }
  }