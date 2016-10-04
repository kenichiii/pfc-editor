<?php 

foreach( token_get_all(file_get_contents(__FILE__))
       as $key=>$value
       )
  {
  echo $key .' => '.json_encode($value).'<hr>';
}
  ;

/*
class CodeInspector {
  
  protected $lines;
  protected $output = array();
  
  public function __construct($file_path) {
      $this->lines = file($file_path);	      
      $this->parse();
  }
  
  
  public function parse() {
    foreach($this->lines as $line=>$code) {
  		$this->parseLine($line,$code);    
    }
  }
  
  public function parseLine($number,$code) {
    
  }
  
  public function output() {
    return $this->output;
  }
  
}

class PhpWordInspector extends CodeInspector {
  public function parseWord($word) {
    switch($word) {
      case 'namespace': break;
      case 'const': break;
      case 'define': break;
      case 'class': break;
      case 'var': break;
      case 'public': break;
      case 'protected': break;
      case 'private': break;
      case 'static': break;
      case 'function': break;
      default: break;
    }
  }
  public function parseLetter($letter) {
    switch($letter) {
      case "'": break;
      case '"': break;
      case '}': break;
      case '{': break;
      case '(': break;
      case ')': break;
      case ',': break;
      case ';': break;
    }
  }
}

class MixedPhp extends CodeInspector {

  public const MODE_HTML = 'html';
  public const MODE_PHP = 'php';
  public const MODE_JAVASCRIPT = 'javascript';
  public const MODE_CSS = 'css';
  
  protected $mode; 
  
  protected $phpParser;
  
  public function parse() {
    $this->mode = self::MODE_HTML;  
    $this->phpParser = new PhpWordInspector();
    parent::parse();
  }
  
  public function parseLine($number,$code) {
     
     $wordBuffer = "";
    
     foreach($code as $key=>$letter) {
       
       if($letter!=" ")
         {
           //build word
           $wordBuffer .= $letter;         
       
             //test word
             switch($wordBuffer) {
               case '<?php': 
                 $this->mode = self::MODE_PHP;  
               break;
               case '?>': 
                 $this->mode = self::MODE_HTML;  
               break;

               case '<script>': 
               case '<script': 
                 $this->mode = self::MODE_JAVASCRIPT;  
               break;
               case '</script>': 
                 $this->mode = self::MODE_HTML;  
               break;

               case '<style': 
                 $this->mode = self::MODE_CSS;  
               break;
               case '</style>': 
                 $this->mode = self::MODE_HTML;  
               break;               

               default:                
               
               break;
             }
         }
         else {                      		   
                   switch($this->mode) {
                      case self::MODE_PHP: 
                        $this->phpParser->parseWord($wordBuffer);
                      break;
                      case self::MODE_HTML: break;
                      case self::MODE_JAVASCRIPT: break;
                      case self::MODE_CSS: break;
                      default: break;
                    }
           
           $wordBuffer = "";
         }
     } 
  }  
}
*/