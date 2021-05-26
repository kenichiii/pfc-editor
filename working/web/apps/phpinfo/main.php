<?php 
    //ensure we have right include path

    set_include_path(implode(PATH_SEPARATOR, [

            realpath(dirname(__FILE__) )

        ]));



require_once '../safescript.php'; 

echo phpinfo();
