<?php


namespace PFC\WebApp\Component;

use PFC\WebApp\Component\View\iView;
use PFC\WebApp\Component\View\TextView;
use PFC\WebApp\AppFile;

class pfcController 
{       
    protected $VIEW_CLASS_NAME = '\\PFC\\WebApp\\Component\\View\\pfcView';
    
    protected $view = null;
    
    public function __construct()
    {
      
    }
    
    public static function redirect($url)
    {
        if($url === '__HOME__') {
            $url = './';
        }
        
        AppFile::sendRedirectHeaders('./');
        exit;
    }
    
    public function getView()
    {
          
        if($this->view === null) {
            switch($this->VIEW_CLASS_NAME) {
                case "HTML": $class = '\\PFC\WebApp\\Component\\View\\HtmlView'; break;
                case "JSON": $class = '\\PFC\WebApp\\Component\\View\\JsonView'; break;
                case "TEXT": $class = '\\PFC\WebApp\\Component\\View\\TextView'; break;
                case "ACTION": $class = '\\PFC\WebApp\\Component\\View\\ActionView'; break;
                case "PCSS": $class = '\\PFC\WebApp\\Component\\View\\PcssView'; break;
                case "PJS": $class = '\\PFC\WebApp\\Component\\View\\PjsView'; break;
                default:
                $class = $this->VIEW_CLASS_NAME;
                    break;            
            }
            
            $this->setView(new $class(str_replace('\\', '/', get_called_class())));    
        }
        
        return $this->view;
    }
    
    public function getResponse()
    {
        return $this->getView();
    }
    
    public function setView(iView $view)
    {
        $this->view = $view;
        return $this;
    }
    
    public function dispatch()
    {
        $this->preDispatch();
        
        $view = $this->indexAction();                
        
        if ($view !== null && !($view instanceOf iView)) {            
            $this->setView(
                    new TextView(
                            is_string($view) 
                            ? $view 
                            : json_encode($view)
                          )
                    );
        }
        
        $this->postDispatch();
        
        return $this->getView();
    }
    
    protected function preDispatch()
    {
        
    }
    
    protected function postDispatch()
    {
        
    }
    
    protected function indexAction()
    {
        
    }
}


