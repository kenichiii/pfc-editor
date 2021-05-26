<?php 
include('phpsec/Net/SSH2.php');
set_include_path(implode(PATH_SEPARATOR,array(get_include_path(),\PFC\Editor\LIBRARY_PATH.'/phpsec')));

$ssh = new Net_SSH2('kena23.cz');
if (!$ssh->login('root', 'kenakena23')) {
    exit('Login Failed');
}
echo $ssh->read('username@username:~$');
echo '<hr>';
//echo $ssh->exec('mkdir test');
$ssh->write("mkdir test\n");
$ssh->write("ls -la\n");
echo $ssh->read('username@username:~$');
echo '<hr>';
$ssh->write("rm -r -i test\n");
echo $ssh->read('username@username:~$');
echo '<hr>';
$ssh->write("y\n");
echo $ssh->read('username@username:~$');
echo '<hr>';

echo $ssh->exec('ls -la');

//echo $ssh->exec('pwd');
//echo $ssh->exec('ls -la');
//echo $ssh->exec('pwd'); // outputs /home/username
//$ssh->exec('cd /var/www');
//echo $ssh->exec('pwd'); // (despite the previous command) outputs /home/username

//$ssh->write("ls -la\n");
//$ssh->write("clear\n"); // note the "\n"
//$ssh->write("ls -la\n"); // note the "\n"
//$ssh->write("clear\n"); // note the "\n"
 //$ssh->reset();
//echo $ssh->read('username@username:~$');
// $ssh->reset();
//echo $ssh->read('username@username:~$');   

/*
echo $ssh->read('username@username:~$');
$ssh->write("ls -la\n"); // note the "\n"
echo $ssh->read('username@username:~$');
*/

/*
echo $ssh->read('username@username:~$');
$ssh->write("sudo ls -la\n");
$output = $ssh->read('#[pP]assword[^:]*:|username@username:~\$#', NET_SSH2_READ_REGEX);
echo $output;
if (preg_match('#[pP]assword[^:]*:#', $output)) {
    $ssh->write("kenakena23\n");
    echo $ssh->read('username@username:~$');
}
*/
