<?php

namespace PFC\WebApp\Component\View;

class TextView implements iView
{
    protected $data;
    
    public function __construct($data)
    {
        $this->setData($data);
    }
    
    public function headers()
    {
        header('Content-type: text/plain');
    }
    
    public function render()
    {
        return $this->getData();
    }
    
    public function getData()
    {
        return $this->data;
    }
    
    public function setData($data)
    {
        $this->data = $data;
        
        return $this;
    }
}

