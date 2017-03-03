<?php

namespace PFC\WebApp\Component\View;

class pfcView implements iView
{
    protected $path;
    protected $name;
    protected $params = [];
    
    public function __construct($path, $params = [], $name = null)
    {
        $this->path = $path;
        $this->name = $name;
        $this->setParams($params);
    }
    
    public function headers()
    {
        //default apache send html headers
    }
    
    public function render()
    {
        foreach ($this->params as $paramName => $paramValue)
        {
            ${$paramName} = $paramValue;
        }
        
        ob_start();
        
        require self::getTemplatePath($this->getPath(), $this->getName());
        
        $output = ob_get_contents();
        ob_end_clean();
        
        return $output;
    }
    
    protected function template($name, array $data = [])
    {
        foreach ($data as $paramName => $paramValue)
        {
            ${$paramName} = $paramValue;
        }
        
        ob_start();
        
        require self::getTemplatePath($this->getPath(), $name);
        
        $output = ob_get_contents();
        ob_end_clean();
        
        return $output;        
    }
    
    protected function component($path)
    {
        $controllerClassName =  "\\".\PFC\WebApp\APPNAME."\\Component\\". \preg_replace_callback(
                            '/([a-zA-Z]){1}(-){1}([a-zA-Z0-9]){1}/',
                            function ($matches) {
                                return $matches[1] . \strtoupper($matches[3]);
                            },
                            \str_replace('/', '\\', $path)
                );
                            
        $controller = new $controllerClassName;                    
        $view = $controller->dispatch();
        return $view->render();
    }
        
    protected function getPath()
    {
        return $this->path;
    }

    protected function getName()
    {
        return $this->name;
    }    
    
    
    
    protected static function getTemplatePath($name, $tplName = null)
    {
        
        $pies = \explode('/', $name);        

            if (\count($pies) > 1) {
                if ($pies[1] === 'Layout') {
                    $pies[1] = 'layouts';
                } elseif ($pies[1] === 'Component') {
                    $pies[1] = 'components';
                }       
            }
            
                     
            if (\count($pies) > 2 && \in_array($pies[2], ['Ajax','Action','Pcss','Pjs'])) {                    
                    $scriptName = $pies[(count($pies)-1)];
                    
                    $pies[] = '_templates';
                    $pies[] = $tplName ? $scriptName.'/'.$tplName : $scriptName;  
                    
                    unset($pies[(count($pies)-3)]);
                    unset($pies[2]);
            } else {
                    $pies[] = '_templates';                    
                    if ($tplName !== null) {
                        $pies[] = $tplName;
                    } else {
                        $pies[] = 'index';
                    }                    
            }
            

            if ($pies[0] === \PFC\WebApp\APPNAME) {
                unset($pies[0]); 
                 
                $path = \PFC\WebApp\APPLICATION_PATH .'/'
                        . preg_replace_callback(
                                '/([a-z0-9]){1}([A-Z]){1}([a-z]){1}/',
                                function ($matches) {
                                    return $matches[1] .'-'
                                            . strtolower($matches[2])
                                            . $matches[3]
                                        ;
                                },
                                implode('/', $pies)
                    );                                               
                                
                if(file_exists($path.'_'.\PFC\WebApp\App::ins()->getLang().'.php')) {
                    return $path.'_'.\PFC\WebApp\App::ins()->getLang().'.php';                    
                } elseif(file_exists($path.'.php')) {
                    return $path.'.php';
                } else {
                    throw new \Exception('Not existing template path: '.$path.'.php');
                }            
                
            } else {
               //????   
            }                    
    }
    
    protected function getControllerClassName()
    {
        return $this->controllerClassName;
    }
    
    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
        
        return $this;
    }    
    
    public function setParams(Array $params)
    {
        foreach ($params as $name => $value)
        {
            $this->params[$name] = $value;
        }
        
        return $this;        
    }
}
