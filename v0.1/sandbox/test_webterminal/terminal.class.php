<?php
/**
 * Terminal
 * Class to interact with the user and the shell process.
 * @author Thiago Bocchile <tykoth@gmail.com>
 * @package xwiterm
 * @subpackage xwiterm-linux
 */

class Terminal {


    private $login;
    private $password;
    
    static $username;
    static $commandsFile = "comandos.txt";
    static $totalCommands;
    static $process;
    static $status;
    static $meta;

    static $instance;

    /**
     * Static function to simply autenticate users.
     * Can be used for other purposes.
     * @param string $login the linux username
     * @param string $password password
     * @access public
     * @return bool - true if login and password is right
     */
    public static function autenticate($login, $password) {


        self::$username = $login;
        $process = new Process("su " . escapeshellarg($login));
        usleep(500000);
        $process->put($password);
        $process->put(chr(13));
        usleep(500000);
        return (bool) !$process->close();
    }

    /**
     * Get the terminal title.
     * @return string
     */
    public static function getTitle(){
        if(!empty(self::$username)){
            $process = new Process("uname -n");
            $title = self::$username."@".trim($process->get());
            $process->close();
            return $title;
        } else {
            return "not logged shell - how cold it be possible, uh?";
        }
    }
    /**
     * Static function to "run" the terminal.
     * It must be used at the end of all html output.
     * @param string $login
     * @param string $password
     * @return bool - true if runs
     */
    public static function run($login, $password){
        self::$instance = new self();
        return self::$instance->open($login, $password);
    }

    /**
     * Simple function to "post" a command in the commands file.
     * @todo Another way to catch the commands, file is ugly.
     * @param string $command
     */
    public static function postCommand($command){
        file_put_contents(self::$commandsFile, $command."\n", FILE_APPEND);
    }

    /**
     * Open the terminal process.
     * @param string $login
     * @param string $password
     * @return bool - true if runs
     */
    private function open($login, $password) {
        $this->login = $login;
        $this->password = $password;

        if(!is_writable(self::$commandsFile)){
            $this->output("\r\nNeed permission to write in ".self::$commandsFile."\r\n");
            return false;
        }

        // Clean commands
        file_put_contents(self::$commandsFile, "");
    
      $this->startProcess();
       
        do {
          
            $out = self::$process->get();
            //can be there for work
            var_dump($out);
          
            // Detect "blocking" (wait for stdin)
            if(sizeof($out) == 1 && ord($out) == 0) {
             // echo "TSET";
                $this->listenCommand();
            } else {
             // echo "AAAA";
                // Provisorio, meldels. (usuario www-data não tem controle de servico, dude!)
              //must be commented
               // if(preg_match('/-su: no job control in this shell/', $out)) continue;
                $this->output($out);
            }
          flush();
          
            usleep(10000);
            self::$status = self::$process->getStatus();
            self::$meta = self::$process->metaData();
          //must be there to work
          var_dump(self::$meta);
          
        } while(self::$meta['eof'] === false);
      
        return true;
    }

    /**
     * Starts the terminal process
     * Uses the class Process.
     * @return true if runs
     */
    private function startProcess() {
     
        self::$process = new Process("su - {$this->login}");
//        self::$process = new Process("vi");
        if(!self::$process->isResource()) {
            throw new Exception("RESOURCE NOT AVAIBLE");
            return false;
        }
        usleep(500000);
        self::$process->put($this->password);
        self::$process->put(chr(13));
        self::$process->get();
        usleep(500000);
      
        self::$status = self::$process->getStatus();
      
      //must be commented
      //self::$meta = self::$process->metaData();
    }

    /**
     * Simulates the terminal colors :)
     * Format the input and returns as html with styles
     * Function to be used with preg_replace.
     * @param string $code
     * @param string $value
     * @return string - the html tag with style
     */
    public function consoleTag($code, $value){
        $attrs = explode(";", $code);

        if(sizeof($attrs) == 2 && intval($attrs[0]) > 10){
            $attrs[2] = $attrs[1];
            $attrs[1] = $attrs[0];

        }

        if(sizeof($attrs) == 2 && intval($attrs[0]) == 0 && intval($attrs[1]) == 0){
            $attrs[0] = 0;
            $attrs[1] = 37;
        }
        $text = array(
            '0' => '',
            '1' => 'font-weight:bold',
            '3' => 'text-decoration:underline',
            '5' => 'blink'
        );
        $colors = array(
            '0' => 'black',
            '1' => 'red',
            '2' => '#89E234', // green
            '3' => 'yellow',
            '4' => '#729FCF', // blue
            '5' => 'magenta',
            '6' => 'cyan',
            '7' => 'white'
        );
        
        $text_decoration = (isset($attrs[0]) && array_key_exists(intval($attrs[0]), $text)) ? $text[intval($attrs[0])] : $text[0];
        $color = (isset($attrs[1]) && array_key_exists(intval($attrs[1])-30, $colors)) ? $colors[intval($attrs[1])-30] : $colors[0];
        $style = sprintf("%s;color:%s;", $text_decoration, $color);
        $style.= (isset($attrs[2]) && array_key_exists((intval($attrs[2])-40), $colors)) ? "background-color:".$colors[(intval($attrs[2])-40)] : '';
        return "<tt style=\\\"$style\\\">$value</tt>";
    }

    /**
     * "Hard" output.
     * It's not a good practice to echo from class methods, so it's a provisory
     * method.
     * @param string $output
     * @param bool $return - true to return the formatted output
     * @param bool $html - true to format html
     * @return mixed - if $return is true, returns the output
     */
    private function output($output, $return = false, $html = true) {

        if(preg_match('/\x08/',$output)) return false;

        $output = htmlentities($output);
        $output = addslashes($output);
       
        $output = explode("\n", $output);
        $output = implode("</span><span>", $output);
        $output = sprintf("<span>%s</span>", $output);
        $output = preg_replace( "/\r\n|\r|\n/", '\n', $output);

        // Removes the first occurrence (on ls)
        $output = preg_replace('/\x1B\[0m(\x1B)/', "\x1B", $output);
        // Add colors to default coloring sytem
        $output = preg_replace('/\x1B\[([^m]+)m([^\x1B]+)\x1B\[0m/e', '$this->consoleTag(\'\\1\',\'\\2\')', $output);
        $output = preg_replace('/\x1B\[([^m]+)m([^\x1B]+)\x1B\[m/e', '$this->consoleTag(\'\\1\',\'\\2\')', $output);
        // Add colors to grep color system
        $output = preg_replace('/\x1B\[([^m]+)m\x1B\[K([^\x1B]+)\x1B\[m\x1B\[K/e', '$this->consoleTag("\\1","\\2")', $output);

        // Removes some dumb chars
        $output = preg_replace('/\x1B\[m/', '', $output);
        $output = preg_replace('/\x07/', '', $output);


        if($return === false){
            echo "<script>recebe(\"{$output}\");</script>\n"; flush();
        } else {
            return $output;
        }
    }

    /**
     * Formats the output to be used as command suggest (pressing TAB)
     * @param string $output
     * @return string
     */
    private function commandSuggest($output){
        $output = preg_replace( "/\n|\r|\r\n/", '', $output);
        $output = preg_replace('/'.chr(7).'/', '', $output);
        return trim($output);
    }

    /**
     * Listener for incoming commands
     */
    private function listenCommand() {

        $commands = file(self::$commandsFile);
        
        if(sizeof($commands) > self::$totalCommands) {
            self::$totalCommands = sizeof($commands);
            $command = $commands[self::$totalCommands-1];
            $this->parse($command);
        }
    }

    /**
     * Parse the command
     * @param string $command - incomming command from terminal
     * @return void
     */
    private function parse($command) {


        switch(trim($command)) {
            case chr(3):
            // SIGTERM
                return $this->sendSigterm();
                break;
            case chr(4):
                self::$process->put("exit");
                self::$process->put(chr(13));
                break;

            case chr(26):
            //STOP - experimental
                return $this->sendSigstop();
                break;
            case 'fg':
                return $this->sendFg();
                break;
            
            default:
                // Checks for "TAB"
                if(ord(substr($command,-2,1)) == 9){
                    self::$process->put(trim($command).chr(9));
                    usleep(500000);
                    
                    $out = self::$process->get();
                    // Check if is a "RE-TAB"
                    if(trim($command) == $this->commandSuggest($out)){
                        self::$process->put(trim($command).chr(9).chr(9));
                        self::$process->put(chr(21));
                        $this->output(self::$process->get());
                    } else {
                        echo "<script>recebe(null, '".$this->commandSuggest($out)."')</script>\n"; flush();
                    }
                    self::$process->put(chr(21));
                } else {
                    self::$process->put(chr(21));
                    self::$process->put(trim($command));
                    self::$process->put(chr(13));
                }

                usleep(500000);
                break;
        }
    }


    /**
     * Emulates the SIGTERM sending via CTRL-C
     * @return void
     */
    private function sendSigterm() {
        // SLAYER!!! GRRRRRRRRRR
        // http://www.youtube.com/watch?v=VSoh3c7QVyw
        $SLAYER = 'pid='.self::$status['pid'].
        '; supid=`ps -o pid --no-heading --ppid $pid`;'.
        'bashpid=`ps -o pid --no-heading --ppid $supid`;'.
        'childs=`ps -o pid --no-heading --ppid $bashpid`;'.
        'kill -9 $childs;';
        $process = new Process("su -c '{$SLAYER}' -l {$this->login}");
        usleep(500000);
        $process->put($this->password);
        $process->put(chr(13));
        usleep(500000);
    }

    /**
     * Simulates the SIGSTOP sending via CTRL-Z
     * @return void
     */
    private function sendSigstop() {
        $SLAYER = 'pid='.self::$status['pid'].
        '; supid=`ps -o pid --no-heading --ppid $pid`;'.
        'bashpid=`ps -o pid --no-heading --ppid $supid`;'.
        'childs=`ps -o pid --no-heading --ppid $bashpid`;'.
        'kill -TSTP $childs;';
        $process = new Process("su -c '{$SLAYER}' -l {$this->login}");
        usleep(500000);
        $process->put($this->password);
        $process->put(chr(13));
        self::$process->put(chr(13));
        usleep(500000);
    }

    /**
     * Simulates the SIGCONT sending via 'fg'
     */
    private function sendFg() {
        $SLAYER = 'pid='.self::$status['pid'].
        '; supid=`ps -o pid --no-heading --ppid $pid`;'.
        'bashpid=`ps -o pid --no-heading --ppid $supid`;'.
        'childs=`ps -o pid --no-heading --ppid $bashpid`;'.
        'kill -CONT $childs;';
        $process = new Process("su -c '{$SLAYER}' -l {$this->login}");
        usleep(500000);
        $process->put($this->password);
        $process->put(chr(13));
        self::$process->put(chr(13));
        usleep(500000);
    }
}
