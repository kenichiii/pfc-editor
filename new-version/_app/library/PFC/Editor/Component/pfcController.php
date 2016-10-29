<?php


namespace PFC\Editor\Component;

use PFC\Editor\Component\View\iView;
use PFC\Editor\Component\View\TextView;

class pfcController 
{       
    protected static $VIEW_CLASS_NAME = '\\PFC\Editor\\Component\\View\\pfcView';
    
    protected $view;
    
    public function __construct()
    {
        $this->setView(
            new self::$VIEW_CLASS_NAME(
                \str_replace('\\', '/', \get_called_class()
                        )
                ));
    }
    
    public function getView()
    {
        return $this->view;
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
        
        $this->postDispatch();
        
        if ($view === null) {
            return $this->getView();
        } elseif ($view instanceOf iView) {
            return $view;
        } else {
            return new TextView(is_string($view) ? $view : json_encode($view));
        }
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


