<?php
require_once '../autoload.php';

use runners\BaseRunner;
use test\StringTest;

$runner = new BaseRunner(StringTest::class);
