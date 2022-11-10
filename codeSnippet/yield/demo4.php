<?php

function logger(): Generator
{
    while (true) {
        yield '234'.PHP_EOL;
        yield '444'.PHP_EOL;
        fwrite(STDOUT, yield . PHP_EOL);
    }
}

$logger = logger();
$logger->rewind();
echo $logger->current(); // 234
echo $logger->send('Foo'); // 444
//echo $logger->send('Bar'.__LINE__); //
//echo $logger->send('Bar'.__LINE__);
//echo $logger->send('Bar'.__LINE__);
//echo $logger->send('Bar'.__LINE__);
//echo $logger->send('Bar'.__LINE__);