<?php

$a = true;

if ($a) {
    echo 'true';
} else label: {
    echo 'false';
}

if ($a) {
    echo 'true';
} else switch ($a) {
    case true:
        echo 'true';
        break;
    default:
        echo 'default';
}

if ($a) {
    echo 'true';
} else for ($i=0; $i < 10;$i++) {
    echo $i;
}

if (!$a) {
    echo 'true';
} else do {
    echo 'do while';
    $a = false;
} while ($a);