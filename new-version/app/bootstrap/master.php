<?php

require_once 'bootstrap/autoload.php';
spl_autoload_register("\PFC\Editor\autoload");



/*
 * ERRORS
 */
if(!isset($_GET['pfc_boot_errors']))
{
    ini_set('display_errors',\PFC\Editor\Config::displayErrors);
    error_reporting(\PFC\Editor\Config::errorReporting);
}



/*
 * PHP INI set
 */
//ini_set("max_execution_time", "60000");

//ini_set('session.cache_expire', \PFC\Editor\Config::session_cache_expire);

//ini_set('upload_max_filesize', \PFC\Editor\Config::upload_max_filesize);
//ini_set('post_max_size', \PFC\Editor\Config::post_max_size);




/*
 * SERVER TIMEZONE
 */
date_default_timezone_set(\PFC\Editor\Config::default_timezone);



/*
 * SESSION
 */
    session_start();




