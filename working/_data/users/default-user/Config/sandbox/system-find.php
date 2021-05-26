<?php 

$dir = \PFC\Editor\LIBRARY_PATH;


 set_include_path(\PFC\Editor\INCLUDE_PATH);

require 'System.php';

//http://www.binarytides.com/linux-find-command-examples/

$system = new System();
   /*
     * System::find($dir);
     * System::find("$dir -type d");
     * System::find("$dir -type f");
     * System::find("$dir -name *.php");
     * System::find("$dir -name *.php -name *.htm*");
     * System::find("$dir -maxdepth 1");
     *
     * Params implmented:
     * $dir            -> Start the search at this directory
     * -type d         -> return only directories
     * -type f         -> return only files
     * -maxdepth <n>   -> max depth of recursion
     * -name <pattern> -> search pattern (bash style). Multiple -name param allowed
     *
     * @param  mixed Either array or string with the command line
     * @return array Array of found files
   */    
$res = $system->find("$dir -name *.php ");
echo '<h2>PEAR SYSTEM $dir -name *.php  <br>FINDED RESULTS WITH PEAR SYSTEM in '.$dir.': '.count($res).'</h2>';
foreach($res as $key=>$match)
  {
     echo $key.' => '.htmlspecialchars( json_encode($match) ).'<hr>';
  }

$r = exec('find '.$dir.' -type f -print | grep -r *.php',$results);
echo '<h2>find '.$dir.' -type f -print | grep -r *.php FINDED: '.count($results).' RESULTS</h2>';
foreach($results as $key2=>$match2)
  {
     echo $key2.' => '.htmlspecialchars( json_encode($match2) ).'<hr>';
  }

echo '<br><br><br>';