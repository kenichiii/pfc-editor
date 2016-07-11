<?php

//http://stackoverflow.com/questions/12152765/php-syntax-checking-with-lint-and-how-to-do-this-on-a-string-not-a-file
    
$code = $_POST['code'];  

$time = microtime(true);

        chmod(\PFC\Editor\APPLICATION_PATH.'/components/editor/_ajax/temp', 0777);

        file_put_contents(\PFC\Editor\APPLICATION_PATH.'/components/editor/_ajax/temp/phpval'.$time.'.php', $code);

        $res = exec ( 'php -l '.\PFC\Editor\APPLICATION_PATH.'/components/editor/_ajax/temp/phpval'.$time.'.php', $errors, $nr );

		unlink(\PFC\Editor\APPLICATION_PATH.'/components/editor/_ajax/temp/phpval'.$time.'.php');

        //$errors[0] = str_replace('in '.\PFC\Editor\APPLICATION_PATH.'/components/editor/_ajax/temp/val.php', '', $errors[0]);
        //$errors[0] = str_replace(\PFC\Editor\APPLICATION_PATH.'/components/editor/_ajax/temp/val.php', '', $errors[0]);    

        if(substr($errors[0], 0,6)=='Errors'||substr(end($errors), 0,6)=='Errors')
        {
//          if(substr($code,0,5)==="<?php")
//          $ccerr = substr($code,5);
//          else
          if((strpos($code,'<?php') && strpos($code,'?>')===false)||
             strrpos($code,'<?php') > strrpos($code,'?>')
            )
          $ccerr = $code.' ?>';  
            else
          $ccerr = $code;
          
          //OMG :)
            $ccerr = str_replace('namespace ','//namespace ',$ccerr);
            $ccerr = str_replace('const ','//const ',$ccerr);
            $ccerr = str_replace('use ','//use ',$ccerr);
          
          
            $mess = \PFC\Editor\SyntaxChecker::php_syntax_error($ccerr);
          
          if($mess) {
            $res = "TRUE";
          }
          else {
            $res = "TRUE";
            $mess = array("Cant detect error in file",1);
          }
        }
        else {
            $res = "FALSE";
            $mess = $errors;
        }
  
echo json_encode(array(

    'errors'=> $res,
    'syntax'=>array('message'=>$mess)
));


