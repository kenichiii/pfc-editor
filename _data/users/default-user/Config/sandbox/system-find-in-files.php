<?php 

$phrase = "pfc";


//http://www.computerhope.com/unix/ugrep.htm
$response = exec('grep -r -n -cvw "$phrase" '.\PFC\Editor\PUBLIC_PATH,$r);



echo '<h2>For phrase '.$phrase.' founded: '.count($r).' results in '.\PFC\Editor\PUBLIC_PATH.'</h2>';
foreach($r as $key=>$match) 
  {
                    //change to mb_
    echo $key.' => '. htmlspecialchars(json_encode($match)) . '<hr>';
    if($key>200) {
      echo '<h2>END FIRST 200 FINDED RESULTS -> CLICK HERE TO LOAD MORE/NEXT 200</h2>';
      break;
    }
  }