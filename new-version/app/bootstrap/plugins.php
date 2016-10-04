<?php

use \PFC\Editor\Config\Sources;

    Sources::$paths ['DOC_ROOT']= array(
             'section'=>'include',              
              'title'=>'DOC ROOT',
              'name'=>'DOC_ROOT',
              'root'=>$_SERVER['DOCUMENT_ROOT'].'/',
              'path'=>'./'      
        
    );


foreach(explode(':',\PFC\EDITOR\INCLUDE_PATH) as $key=>$path)
{
  $readable = @is_readable($path);
  
  if($readable){
    //if($path!='.') {  
    Sources::$paths ['dir'.$key]= array(
             'section'=>'include',              
              'title'=>'dir'.$key,
              'name'=>'dir'.$key,
              'root'=>$path.'/',
              'path'=>'./'      
        
    );
    }
  //}
}

