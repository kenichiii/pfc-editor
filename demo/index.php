<?php

/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/

if(isset($_GET['pfc_boot_errors']))
{    
    ini_set('display_errors',1);
    error_reporting(E_ALL);
}

// Define path to editor directory
defined('\PFC\Editor\PUBLIC_PATH')
    || define('PFC\Editor\PUBLIC_PATH', realpath(dirname(__FILE__) )
            );

// Define path to editor directory
defined('\PFC\Editor\LIBRARY_PATH')
    || define('PFC\Editor\LIBRARY_PATH', realpath(dirname(__FILE__) ).
            '/app/library'
            );

// Define path to editor directory
defined('\PFC\Editor\APPLICATION_PATH')
    || define('PFC\Editor\APPLICATION_PATH', realpath(dirname(__FILE__) ).
            '/app'
            );

defined('\PFC\Editor\SANDBOX_PATH')
    || define('PFC\Editor\SANDBOX_PATH', realpath(dirname(__FILE__) ).
            '/sandbox'
            );



        // Ensure library/ and editor/ are on include_path
        set_include_path(implode(PATH_SEPARATOR, array(           
            \PFC\Editor\LIBRARY_PATH,         
            \PFC\Editor\APPLICATION_PATH
        )));

    //lets boot editor
    require_once 'bootstrap.php';    



