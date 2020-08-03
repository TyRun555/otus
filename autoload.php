<?php
//TODO сделать генерацию autoload файла
$testClassesFiles = glob(__DIR__ . '/Test/*.php');
foreach ($testClassesFiles as $fileName) {
    require_once $fileName;
}

require_once __DIR__ . '/Runners/BaseRunner.php';