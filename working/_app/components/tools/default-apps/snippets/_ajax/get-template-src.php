<?php

  $t = isset($_GET['template'])?$_GET['template']:$_POST['template'];
  $t = str_replace('#', '', $t);
  $t = str_replace('_', '/', $t);
  
  \PFC\Editor\App::bufferOn();
  require \PFC\Editor\APPLICATION_PATH.'/components/tools/default/snippets/'.$t.'.php';
  $code = \PFC\Editor\App::bufferEnd();
  
  echo \PFC\TemplateFactory\TemplateFactory::translatePHP($code);
  