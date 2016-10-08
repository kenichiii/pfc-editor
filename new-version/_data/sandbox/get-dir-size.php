<?php 
    $units = explode(' ', 'B KB MB GB TB PB');
    $SIZE_LIMIT = 5368709120; // 5 GB
    $disk_used = foldersize($_SERVER['DOCUMENT_ROOT']);

    $disk_remaining = $SIZE_LIMIT - $disk_used[0];

    echo("<html><body>");
    echo('diskspace used: ' . format_size($disk_used[0]) . '<br>');
    echo( 'diskspace left: ' . format_size($disk_remaining) . '<br><hr>');
echo( 'inside folders count: ' . $disk_used[2] . '<br><hr>');
echo( 'inside files count: ' . $disk_used[1] . '<br><hr>');
    echo("</body></html>");


function foldersize($path) {
    $total_size = 0;
    $filesCount = 0;
    $foldersCount = 0;
    $files = scandir($path);
    $cleanPath = rtrim($path, '/'). '/';

    foreach($files as $t) {
        if ($t<>"." && $t<>"..") {
            $currentFile = $cleanPath . $t;
            if (is_dir($currentFile)) {
                $size = foldersize($currentFile);
              
                $total_size += $size[0];
                $foldersCount += $size[2]+1;
                $filesCount += $size[1];
            }
            else {
                $size2 = filesize($currentFile);
                $total_size += $size2;                
                $filesCount++;
            }
        }   
    }

    return array($total_size,$filesCount,$foldersCount);
}


function format_size($size) {
    global $units;

    $mod = 1024;

    for ($i = 0; $size > $mod; $i++) {
        $size /= $mod;
    }

    $endIndex = strpos($size, ".")+3;

    return substr( $size, 0, $endIndex).' '.$units[$i];
}

