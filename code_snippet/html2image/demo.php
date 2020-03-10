<?php

require __DIR__ .'/vendor/autoload.php';

// 首先实例类，根据系统不同，选择不一样的脚本程序

$imageSnappy = new \Knp\Snappy\Image(__DIR__ . '/vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64');

// 如果有中文的话，需要添加中文字体
$ttf = __DIR__ . '/ttf/sc.ttf';
// 需要合成的图片地址，base64也可以的，其实跟这个也无关，主要是html能静态展示，那么合成的就是什么样的
$image_url = 'https://www.php.net/images/logos/php-logo.svg';
$name = 'wkhtmltoimage';

// html代码，随意搞了搞，真实使用的话，需要用心调整样式哦~
$htmlTemplate = <<<EOF
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>海报</title>
</head>
<style>
    @font-face {
        font-family: myFirstFont;
        src: url('{$ttf}');
    }

    body {
        font-family: myFirstFont;
    }
</style>
<body>
<img src="{$image_url}">
<br>
{$name}
</body>
</html>
EOF;

$output = __DIR__ . '/demo/'.time().'.jpg';
$imageSnappy->generateFromHtml($htmlTemplate, $output);

echo 'ok';