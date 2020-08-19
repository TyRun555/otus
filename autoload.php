<?php
//TODO сделать генерацию autoload файла
$testClassesFiles = glob(__DIR__ . '/Test/core/*.php');
foreach ($testClassesFiles as $fileName) {
    require_once $fileName;
}

require_once __DIR__ . '/Runners/core/BaseRunner.php';