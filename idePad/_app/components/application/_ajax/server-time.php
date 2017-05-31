<?php 

namespace idePad\Component\Ajax\application;

use PFC\WebApp\Component\AjaxController;

class serverTime extends AjaxController
{
   protected $VIEW_CLASS_NAME = '\\PFC\\WebApp\\Component\\View\\HtmlView';
   
   public function indexAction() 
   {
      $this->getView()->setData(date('j.n.Y G:i:s'));
   }
}
    