<?php

/*
    pfc editor :: online developnent tool
    -------------------------------------
    
    Copyright (C) 2015  Martin Königsmark

*/

namespace {

    //check and set showing php errors
    if(filter_input(INPUT_GET, 'pfc_boot_errors')) {    
        ini_set('display_errors',1);
        error_reporting(E_ALL);
    }

    // Define paths to editor default directories
    defined('\PFC\Editor\INCLUDE_PATH')
        || define('PFC\Editor\INCLUDE_PATH', get_include_path() 
                );
    
    defined('\PFC\Editor\PUBLIC_PATH')
        || define('PFC\Editor\PUBLIC_PATH', realpath(dirname(__FILE__) )
                );
    
    defined('\PFC\Editor\LIBRARY_PATH')
        || define('PFC\Editor\LIBRARY_PATH', realpath(dirname(__FILE__) ).
                '/../app/library'
                );
    
    defined('\PFC\Editor\APPLICATION_PATH')
        || define('PFC\Editor\APPLICATION_PATH', realpath(dirname(__FILE__) ).
                '/../app'
                );
    
    defined('\PFC\Editor\SANDBOX_PATH')
        || define('PFC\Editor\SANDBOX_PATH', realpath(dirname(__FILE__) ).
                '/../_data/sandbox'
                );
    
    defined('\PFC\Editor\DATA_PATH')
        || define('PFC\Editor\DATA_PATH', realpath(dirname(__FILE__) ).
                '/../_data'
                );

        // Ensure library/ and editor/ are on include_path
        set_include_path(implode(PATH_SEPARATOR, [
            PFC\Editor\LIBRARY_PATH,         
            PFC\Editor\APPLICATION_PATH
        ]));

    //lets boot editor
    require_once 'bootstrap.php';    
}
