<?php

namespace {

     set_include_path(implode(PATH_SEPARATOR, [

            realpath(dirname(__FILE__) )

        ]));

 require_once '../_app/config/Editor.php';

 require_once '../_library/PFC/Crypting/iCrypting.php';

 require_once '../_library/PFC/Crypting/Simple.php';
 require_once '../_library/PFC/Crypting/Bcrypt.php';
 
$pwd = filter_input(INPUT_POST, 'pwd');

if(\PFC\Editor\Config::crypting === 'bcrypt') {
    $cry = new \PFC\Crypting\Bcrypt(\PFC\Editor\Config::BcryptRounds);
} else {
    $cry = new \PFC\Crypting\Simple(\PFC\Editor\Config::$SALT);
}

    $hash = $pwd ? $cry->hash($pwd) : false;
?>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
      <form action="./pwdgen.php" method="post">  
        PSSWORD TO GENERATE HASH: <input type="password" name="pwd">
        <br>
        <input type="submit" value="GENERATE">
      </form>  
      <?php 
        if($hash) {
            echo "GENERATED HASH FOR CONFIG FILE:<br>{$hash}";
        }
      ?>  
    </body>
</html>
<?php } ?>