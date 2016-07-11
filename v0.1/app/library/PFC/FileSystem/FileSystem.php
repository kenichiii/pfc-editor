<?php

namespace PFC\FileSystem;

class FileSystem
{
    
    protected $root;
    
    public function __construct($rootPath) {
        $this->setRootPath($rootPath);
    }
    
    public function setRootPath($path) {
        if(!preg_match('/(\/)$/', $path)) $path.='/';
        $this->root = $path;
    }
    
    public function getRootPath() {
        return $this->root;
    }    

    public function getPath($path) {
        if(preg_match('/^(\/)/', $path)) $path='.'.$path;
        return $this->getRootPath().$path;
    }
    
    public function getLastModificationTime($path) 
    {
        return filemtime($this->getPath($path));
    }
    
    
    public function fileExists($path) {   
      $readable = @file_exists($this->getPath($path))  ;
        return $readable;// && file_exists($this->getPath($path));
    }
    
    public function isDir($path) {
      $readable = @is_dir($this->getPath($path))  ;
        return $readable;// && is_dir($this->getPath($path));
    }    
    
    public function createNewFile($path,$contents) {
       if( $f = fopen($this->getPath($path), "w") )
       {
            fwrite($f, $contents);
            fclose($f);
         return true;   
       } else return false;
    }
    
    public function createNewFolder($path) {
       return mkdir($this->getPath($path));
    }
    
    public function renaming($oldname, $newname) {
       return rename($this->getPath($oldname), $this->getPath($newname));
    }
    
    public function whatIsIt($path) {
       return filetype($this->getPath($path));
    }
    
    public function deleteFile($path) {
       return unlink($this->getPath($path));               
    }
    
    private function deleteDir($path) 
    {
         foreach(scandir($this->getPath($path)) as $file)
         {
             if ('.' === $file || '..' === $file)
             {
                 continue;
             }
             if (filetype($this->getPath($path).'/'.$file) == 'dir')
             {
                 $this->deleteDir($path.'/'.$file);
             }
             else
             {
                 unlink($this->getPath($path).'/'.$file);
             }                        
         }
         return rmdir($this->getPath($path));
    }    
    
    public function delete($path)
    {
        if(filetype($this->getPath($path)) == 'file')
        {
            return  unlink($this->getPath($path));
        }
        else
        {
            if(filetype($this->getPath(substr($path, 0, strlen($path) - 1))) == 'dir')
            {
                return $this->deleteDir(substr($path, 0, strlen($path) - 1));
            }
            else
            {
                return false;
            }
        }
    }
    
    public function createBackupFile($pathsource,$pathtarget) {
       return copy($this->getPath($pathsource),$this->getPath($pathtarget));
    }
    
    public function security($path,$action,$newright)
    {
       if(!$action)
       {
           $perm = substr(sprintf('%o', fileperms($this->getPath($path))), -4);
           return $perm;
       }
       else
       {
           return chmod($this->getPath($path),octdec($newright));
       }
    }
    
    public function writeFileContents($path,$contents) {
        return file_put_contents($this->getPath($path), $contents);
    }
    
    public function getFileContents($path) {
        return file_get_contents($this->getPath($path));
    }
    
    public function scandir($path) {
        	$files = scandir($this->getPath($path));
                natcasesort($files);
                return $files;
    }

    public function filesize($path) {
        	return filesize($this->getPath($path));
    }    

public function foldersize($path) {
  $total_size = 0;
  $files = $this->scandir($path);

  foreach($files as $t) {
    if ($this->isDir(rtrim($path, '/') . '/' . $t)) {
      if ($t<>"." && $t<>"..") {
          $size = $this->foldersize(rtrim($path, '/') . '/' . $t);

          $total_size += $size;
      }
    } else {
      $size = $this->filesize(rtrim($path, '/') . '/' . $t);
      $total_size += $size;
    }
  }
  return $total_size;
}

public static function formatSize($size) {
  $mod = 1024;
  $units = explode(' ','B KB MB GB TB PB');
  for ($i = 0; $size > $mod; $i++) {
    $size /= $mod;
  }

  return round($size, 2) . ' ' . $units[$i];
}

public function file($path)
{
    return file($this->getPath($path));
}

public function getLineWithString($fileName, $str) {
    $lines = $this->file($fileName);
    foreach ($lines as $lineNumber => $line) {
        if (strpos($line, $str) !== false) {
            return $line;
        }
    }
    return -1;
}

public function readFile($path) {
  return readfile($this->getPath($path));
}  
  
}