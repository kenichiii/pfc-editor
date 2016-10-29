<?php

namespace PFC\Editor\Component\View;

class HtmlView extends TextView
{
    public function headers()
    {
        \header('Content-type: text/html');
    }
    
    public function render()
    {
        return parent::render();
    }
}