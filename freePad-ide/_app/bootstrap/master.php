<?php

namespace {
    
    require_once 'bootstrap/autoload.php';
    spl_autoload_register("\PFC\WebApp\autoload");

    $config = '\\'.\PFC\WebApp\APPNAME.'\\Config\\WebAppConfig';

    /*
     * ERRORS
     */
    if(!filter_input(INPUT_GET, 'pfc_boot_errors')) {
        ini_set('display_errors', $config::display_errors());
        error_reporting($config::error_reporting());
    }
    
    
    /*
     * SERVER TIMEZONE
     */
    date_default_timezone_set($config::default_timezone());

    //get translator function _();
    require_once \PFC\WebApp\LIBRARY_PATH . '/PFC/WebApp/__translator.php';
} 



