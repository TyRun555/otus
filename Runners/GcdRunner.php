<?php
require_once '../autoload.php';
require_once '../Test/GcdTest.php';

use runners\BaseRunner;
use test\GcdTest;

$runner = new BaseRunner(GcdTest::class);
