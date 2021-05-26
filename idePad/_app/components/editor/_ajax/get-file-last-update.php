<?php 

namespace idePad\Component\Ajax\editor;

use PFC\Editor\Component\AjaxController;

class getFileLastUpdate extends AjaxController
{
    
   public function indexAction() 
   {
   
            $root = filter_input(INPUT_POST, 'root');
            $path = filter_input(INPUT_POST, 'path');
            $last = filter_input(INPUT_POST, 'lu');

            $fs = new \PFC\Editor\Sources($root);

            if($fs->fileExists($path))
              {
                 $return = [
                    'uptodate'=> $fs->getLastModificationTime($path)>$last
                      ? 'no' : 'yes',
                     "actualTime" => $fs->getLastModificationTime($path)
                 ];

              }
            else
              {
                 $return = ['uptodate' => 'not-exists'];
              }
              
       $this->getView()->setData($return);       
   }
}

