<?php

//http://stackoverflow.com/questions/4914750/how-to-zip-a-whole-folder-using-php

//exec('tar -czf backup.tar.gz /path/to/dir-to-be-backed-up/');
/*

down vote
	

$archive_name = 'path\to\archive\arch1.tar';
$dir_path = 'path\to\dir';

$archive = new PharData($archive_name);
$archive->buildFromDirectory($dir_path); // make path\to\archive\arch1.tar
$archive->compress(Phar::GZ); // make path\to\archive\arch1.tar.gz
unlink($archive_name); // deleting path\to\archive\arch1.tar

*/


