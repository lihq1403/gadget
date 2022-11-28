<?php

// mcrypt相关函数已经在php7弃用了，需要自己安装才行

function encryptDecrypt($key, $string, $decrypt)
{
    if ($decrypt) {
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_encode($string), MCRYPT_MODE_CBC, md5(md5($key))), '12');
    } else {
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
    }
}

$encrypt = encryptDecrypt('password', 'HelloWorld', 0);

echo $encrypt;

echo encryptDecrypt('password', $encrypt, 1);