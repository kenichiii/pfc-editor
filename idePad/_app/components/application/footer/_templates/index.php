

             <ul>                 
              <li style="color:#ddd">
               <span style="max-width:400px;overvflow:hidden;display:block;float:left">              
		PHP USER: <?php 
                $user = function_exists('posix_getpwuid') ? @posix_getpwuid(@posix_geteuid()) : exec('whoami'); 
                echo is_array($user) ? $user['name']:$user; 
                ?> 
               </span>  
               <span style="max-width:420px;overvflow:hidden;display:block;float:left">            
                SERVER: <?php echo $_SERVER['SERVER_SOFTWARE']; ?>         
               </span>
	       <span style="overvflow:hidden;display:block;float:left">
                <?php echo 'PHP version: ' . phpversion(); ?>
               </span>               
              </li>
             </ul>

             <span id="copy" style="width:auto">               		                 
                &copy; <?php echo date('Y'); ?> <em>ide</em>Pad
             </span>

