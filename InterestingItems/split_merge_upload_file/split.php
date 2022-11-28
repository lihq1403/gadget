<?php

// 分割文件脚本

$fp = fopen(__DIR__.'/tmp.jpg', 'rb');

$file_size = 1024*1024; // 字节
$i = 0;
$no = 1;

while (!feof($fp)) {
    $file = fread($fp, $file_size);
    $fp2 = fopen(__DIR__.'/split/tmp.port'.sprintf("%04d", $no).'.'.$i.'-'.($i + $file_size). '.tmp', 'wb+');
    fwrite($fp2, $file, $file_size);
    fclose($fp2);
    $i += $file_size + 1;
    $no++;
}
fclose($fp);





// feof() 函数检查是否已到达文件末尾（EOF）