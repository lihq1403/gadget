<?php

// 合并文件脚本

$file_list = glob(__DIR__.'/split/*tmp*.tmp');

$file_size = 1024*1024;
$mergeFileName = __DIR__.'/merge/tmp_merge.jpg';

//unlink($mergeFileName);
$fp2 = fopen($mergeFileName, 'w+');
foreach ($file_list as $k => $v) {
    $fp = fopen($v, 'rb');
    $content = fread($fp, $file_size);

    fwrite($fp2, $content, $file_size);
    unset($content);
    fclose($fp);
    echo $k . PHP_EOL;
}
fclose($fp2);


// glob() 函数返回匹配指定模式的文件名或目录。