<?php
/**
 * Class to control the process.
 * @author Thiago Bocchile <tykoth@gmail.com>
 * @package xwiterm
 * @subpackage xwiterm-linux
 */
class Process {
    public $pipes;
    public $process;

    public function __construct($command) {
        return $this->open($command);
    }

    public function __destruct() {
        return $this->close();
    }

    public function open($command) {
        $spec = array(
                array("pty"), // MAGIC - THE GATHERING!! MWAHAHAHAHA
                array("pty"),
                array("pty")
        );

        $this->process = proc_open($command, $spec, $this->pipes);
        if(!$this->setBlocking(0))
          {
            echo "CANT SET BLOCKING";
          }
    }

    public function isResource() {
        return is_resource($this->process);
    }
    public function setBlocking($blocking = 1) {
      //On Windows this function does not work with pipes opened with proc_open (https://bugs.php.net/bug.php?id=47918, https://bugs.php.net/bug.php?id=34972, https://bugs.php.net/bug.php?id=51800)
        return stream_set_blocking($this->pipes[1], $blocking);
    }
    public function getStatus() {
        return proc_get_status($this->process);
    }
    public function get() {
//		$out = fread($this->pipes[1], 128);
//		$out = fgets($this->pipes[1]);
        $out = stream_get_contents($this->pipes[1]);
        return $out;
    }
    
    public function put($data) {
//		fwrite($this->pipes[1], $data."\n");
        fwrite($this->pipes[1], $data);
//		fwrite($this->pipes[1], chr(13));
        fflush($this->pipes[1]);
//		return fwrite($this->pipes[1], $data);
    }

    public function close() {
        if(is_resource($this->process)) {
            fclose($this->pipes[0]);
            fclose($this->pipes[1]);
            fclose($this->pipes[2]);
            return proc_close($this->process);
        }
    }
  
    public function metaData() {
      //var_dump($this->pipes[1]);
        return stream_get_meta_data($this->pipes[1]);
    
    }
}
