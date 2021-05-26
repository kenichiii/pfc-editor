
    
        
        <button id="pfc-tools-color-picker"><?php echo _tr('color picker'); ?></button>
        <button id="pfc-tools-calculator"><?php echo _tr('calculator'); ?></button>
        <button href="http://paletton.com/" class="pfc-editor-external-link"><?php echo _tr('color scheme generator'); ?></button>
        
      <hr>
      
		
		<button id="pfc-editor-specchars-href" class="pfc-editor-external-link" href="http://typeit.org"><?php echo _tr('special chars'); ?></button>
		<button id="pfc-editor-charcodes-href" class="pfc-editor-external-link" href="http://character-code.com/"><?php echo _tr('character codes'); ?></button>
      
      <hr> 
            <b><?php echo _tr('JS'); ?></b>
            <button href="http://phpjs.org/functions/"    class="pfc-editor-external-link"><?php echo _tr('PhpJS.org'); ?></button>
            
            <b><?php echo _tr('KEY CODE'); ?></b> 
            <button id="pfc-tools-js-keypress-code"><?php echo _tr('keypress'); ?></button> 
            <button id="pfc-tools-js-keydown-code"><?php echo _tr('keydown/up'); ?></button>
            
      <hr>  
	
	        <b><?php echo _tr('SERVER'); ?></b> 
	        <button id="pfc-editor-phpinfo-href" class="pfc-editor-page-href" href="#phpinfo"><?php echo _tr('phpinfo'); ?></button>
      
      <hr>
<br>
                   <?php echo $this->component('tools/default-apps/snippets');?>
