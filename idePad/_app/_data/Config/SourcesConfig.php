<?php

return [

          /**
           * DEFAULT WORKSPACE
           */  
          'workspace' => [
              'section'=>'sources',              
              'title'=>'Workspace',
              'name'=>'workspace',
              'root'=>\PFC\WebApp\PUBLIC_PATH,
              'path'=>'../../'
          ],
               
        
          /**
           * USER DATA SANDBOX 
           */
          'sandbox' => [
              'section'=>'sources',
              'title'=>'Sandbox',
              'name'=>'sandbox',
              'root'=>\PFC\WebApp\USER_DATA_SANDBOX_PATH,
              'path'=>'./'
          ],          

          /**
           * USER DATA HOME 
           */        
          'my-home' => [
              'section'=>'my-home-src',
              'title'=>'MY HOME',
              'name'=>'my-home',
              'root'=>\PFC\WebApp\USER_DATA_HOME_PATH,
              'path'=>'./'
          ],  
          
          
        
         /**
          * IDEPAD SOURCES
          */
        
          'pfc-public' => [
              'section'=>'idePad-src',
              'title'=>'Public',
              'name'=>'pfc-public',
              'root'=>\PFC\WebApp\PUBLIC_PATH,
              'path'=>'./'
          ],
        
         'pfc-app' => [
               'section'=>'idePad-src',
                'title'=>'app',
                'name'=>'pfc-app',
                'root'=>\PFC\WebApp\APPLICATION_PATH,
                'path'=>'./'              
          ],
        
          'pfc-lib' => [
                'section'=>'idePad-src',
                'title'=>'lib',
                'name'=>'pfc-lib',
                'root'=>\PFC\WebApp\LIBRARY_PATH,
                'path'=>'./'              
          ],

          'pfc-data' => [
                'section'=>'idePad-src',
                'title'=>'data',
                'name'=>'pfc-data',
                'root'=>\PFC\WebApp\DATA_PATH,
                'path'=>'./'              
          ],
        
          'pfc-cfg' => [
                'section'=>'idePad-src',
                'title'=>'cfg',
                'name'=>'pfc-cfg',
                'root'=>\PFC\WebApp\APPLICATION_PATH,
                'path'=>'./configs/'              
          ],                                
];

