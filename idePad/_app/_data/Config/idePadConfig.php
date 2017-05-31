<?php

return [
    'header' => [
        
        'logo' => [
            'type' => 'page',
            'href' => 'ide-pad/editor-home',
        ],
        
        'main-menu' => [
            [
                'text' => 'Sources',
                'type' => 'section',                
                'href' => 'sources',
            ],
            [
                'text' => 'Adminer',
                'type' => 'page',
                'href' => 'core/adminer',
            ],
            [
                'text' => 'Webconsole',
                'type' => 'page',
                'href' => 'core/webconsole',
            ],            
            [
                'text' => 'My notes',
                'type' => 'file',
                'path' => \PFC\WebApp\USER_DATA_NOTES_TXT_PATH,
            ],
            [
                'text' => 'My home',
                'type' => 'section',
                'href' => 'my-home-src',
            ],
        ],
        
        'right-menu' => [
           [
               'text' => 'About',
               'type' => 'page',
               'href' => 'core/ide-pad/editor-about'
           ],
           [
               'text' => 'Help',
               'type' => 'page',
               'href' => 'core/ide-pad/editor-help'
           ],
           [
               'text' => 'Editor src',
               'type' => 'section',
               'href' => 'idePad-src'
           ],
           [
               'text' => 'Settings',
               'type' => 'page',
               'href' => 'core/ide-pad/editor-settings'
           ], 
        ],
    ],
    
    'sections' => [        
        'core/sources',
    ],
    
    'tools-sections' => [
        'core/tools',
    ],
    
    'editor' => [
        //file
        //page
        //external page
    ],
];
