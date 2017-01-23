<?php


namespace PFC\Editor\Component;

use PFC\Editor\Component\View\iView;
use PFC\Editor\Component\View\TextView;

class pfcController 
{       
    protected $VIEW_CLASS_NAME = '\\PFC\Editor\\Component\\View\\pfcView';
    
    protected $view = null;
    
    public function __construct()
    {
        
    }
    
    public function getView()
    {
          
        if($this->view === null) {
            $this->setView(
                new $this->VIEW_CLASS_NAME(
                    str_replace('\\', '/', get_called_class()
                        )
                    ));    
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


