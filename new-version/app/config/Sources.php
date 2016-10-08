<?php 

namespace PFC\Editor\Config;

class Sources
{
    public static $paths = array(

          'public'=>array(
              'section'=>'sources',              
              'title'=>'Workspace',
              'name'=>'public',
              'root'=>\PFC\Editor\PUBLIC_PATH,
              'path'=>'../../../'
          ),
        

        

          'sandbox-src'=>array(
              'section'=>'sandbox',
              'title'=>'Sandbox',
              'name'=>'sandbox-src',
              'root'=>\PFC\Editor\SANDBOX_PATH,
              'path'=>'./'
          ),          

        

          'pfc-public'=>array(
              'section'=>'editor',
              'title'=>'Public',
              'name'=>'pfc-public',
              'root'=>\PFC\Editor\PUBLIC_PATH,
              'path'=>'./'
          ),
          'pfc-app'=>array(
               'section'=>'editor',
                'title'=>'app',
                'name'=>'pfc-app',
                'root'=>\PFC\Editor\APPLICATION_PATH,
                'path'=>'./'              
          ),
          'pfc-lib'=>array(
                'section'=>'editor',
                'title'=>'lib',
                'name'=>'pfc-lib',
                'root'=>\PFC\Editor\LIBRARY_PATH,
                'path'=>'./'              
          ),
          'pfc-assets'=>array(
                'section'=>'editor',
                'title'=>'assets',
                'name'=>'pfc-assets',
                'root'=>\PFC\Editor\PUBLIC_PATH,
                'path'=>'./assets/'              
          ),
          'pfc-cfg'=>array(
                'section'=>'editor',
                'title'=>'cfg',
                'name'=>'pfc-cfg',
                'root'=>\PFC\Editor\APPLICATION_PATH,
                'path'=>'./config/'              
          ),                                
    );
    
}