<?php 

namespace PFC\Editor\Component\View;

class PcssView extends pfcView
{
    public function headers()
    {
        header('Content-type: text/css');
    }
    
    public function render()
    {
        return parent::render();
    }
}