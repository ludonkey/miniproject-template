<?php

spl_autoload_register(function ($className) {
    $vendorPath = __DIR__ . DIRECTORY_SEPARATOR;
    $srcPath = $vendorPath . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    if (file_exists($srcPath . $classPath)) {
        require $srcPath . $classPath;
    } else if (file_exists($vendorPath . $classPath)) {
        require $vendorPath . $classPath;
    }
});
