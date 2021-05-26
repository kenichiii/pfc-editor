<?php 

namespace pfcEditor\Component\Ajax\app;

use PFC\Editor\Component\AjaxController;
use PFC\Editor\Component\View\TextView;

class serverTime extends AjaxController
{
   protected $VIEW_CLASS_NAME = '\\PFC\\Editor\\Component\\View\\HtmlView';
   
   public function indexAction() 
   {
      $this->getView()->setData(date('j.n.Y G:i:s'));
   }
}
    