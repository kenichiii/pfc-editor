<?php
$memory_limit = ini_get('memory_limit');
if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
    if ($matches[2] == 'M') {
        $memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
    } else if ($matches[2] == 'K') {
        $memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
    }
}

$ok = ($memory_limit >= 640 * 1024 * 1024); // at least 64M?

echo '<phpmem>';
echo '<val>' . $memory_limit . '</val>';
echo '<ok>' . ($ok ? 1 : 0) . '</ok>';
echo '</phpmem>';
