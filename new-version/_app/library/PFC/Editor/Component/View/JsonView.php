<?php

namespace PFC\Editor\Component\View;

class JsonView extends TextView
{
    public function headers()
    {
        \header('Content-type: text/json');
    }
    
    public function render()
    {
        return \json_encode(parent::render());
    }
}

