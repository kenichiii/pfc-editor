<?php

namespace {

    //check and set showing php errors
    if(filter_input(INPUT_GET, 'pfc_boot_errors')) {    
        ini_set('display_errors',1);
        error_reporting(E_ALL);
    }

    defined('\PFC\WebApp\APPNAME')
        || define('PFC\WebApp\APPNAME', 
                    'idePad'
                );    
    
    // Define paths to editor default directories
    defined('\PFC\WebApp\INCLUDE_PATH')
        || define('PFC\WebApp\INCLUDE_PATH', get_include_path() 
                );
    
    defined('\PFC\WebApp\PUBLIC_PATH')
        || define('PFC\WebApp\PUBLIC_PATH', realpath(dirname(__FILE__) 
                ));
    
    defined('\PFC\WebApp\LIBRARY_PATH')
        || define('PFC\WebApp\LIBRARY_PATH', realpath(dirname(__FILE__) .
                '/../_app/_library'
                ));
    
    defined('\PFC\WebApp\APPLICATION_PATH')
        || define('PFC\WebApp\APPLICATION_PATH', realpath(dirname(__FILE__) .
                '/../_app'
                ));    
    
    defined('\PFC\WebApp\DATA_PATH')
        || define('PFC\WebApp\DATA_PATH', realpath(dirname(__FILE__) .
                '/../_app/_data'
                ));

        // Ensure library/ and editor/ are on include_path
        set_include_path(implode(PATH_SEPARATOR, [
            PFC\WebApp\LIBRARY_PATH,         
            PFC\WebApp\APPLICATION_PATH,
            PFC\WebApp\DATA_PATH,
        ]));

    //lets boot editor
    require_once 'bootstrap.php';    
}
