<?php

function getValues(): Generator
{
    for ($i = 1; $i < 800000; $i++) {
        yield $i;
        if (($i % 200000) == 0) {
            echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB'. PHP_EOL;
        }
    }
}
echo 'foreach 前'. round(memory_get_usage() / 1024 / 1024, 2) . ' MB' . PHP_EOL;
$values = getValues();
//foreach(getValues() as $value) {
//}
echo 'foreach 后'.round(memory_get_usage() / 1024 / 1024, 2) . ' MB' . PHP_EOL;