<?php

function __autoload(string $classname)
{
    $file = $classname . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}

AutoloadDemo::hello();