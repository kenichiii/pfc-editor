<?php

\PFC\Editor\App::bufferOn();
 phpinfo();
$str = \PFC\Editor\App::bufferEnd();

echo htmlspecialchars( preg_match('/System <\/td>([^.]+)/',$str,$m) );
  
echo htmlspecialchars( $m[0] );

echo $str;  