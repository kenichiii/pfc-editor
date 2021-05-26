<?php

namespace pfcEditor\Component\Ajax\sections\sources;

use PFC\Editor\Component\AjaxController;

class update extends AjaxController
{
   protected $VIEW_CLASS_NAME = "HTML";
           
   public function indexAction() 
   {           
        @set_time_limit(0);

        $dd = json_decode(filter_input(INPUT_POST, 'dir'));

        if($dd->root)
        {
                $root = $dd->root;  

        $fs = new \PFC\Editor\Sources($root);

        $dirs = explode('/',filter_input(INPUT_SERVER, 'REQUEST_URI'));
        $actualDir = $dirs[count($dirs)-2];

        $dir = $dd->path;

        $opendirs = $dd->openedDirs;  

        $output = $fs->printDir($dir,$opendirs);  

        }
        else $output = "no root provided";
        
        $this->getResponse()->setData($output);
   }
}