<?php

namespace {
    
    require_once 'bootstrap/autoload.php';
    spl_autoload_register("\PFC\Editor\autoload");

    use PFC\Editor\Config;

    /*
     * ERRORS
     */
    if(!filter_input(INPUT_GET, 'pfc_boot_errors')) {
        ini_set('display_errors', Config::displayErrors);
        error_reporting(Config::errorReporting);
    }
    
    
    /*
     * SERVER TIMEZONE
     */
    date_default_timezone_set(Config::default_timezone);

    //get translator function _();
    require_once \PFC\Editor\LIBRARY_PATH . '/PFC/Editor/__translator.php';
} 



