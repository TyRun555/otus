<?php
require_once '../autoload.php';
require_once '../Test/StringTest.php';

use runners\BaseRunner;
use test\StringTest;

$runner = new BaseRunner(StringTest::class);
