<?php
require_once '../autoload.php';
require_once '../Test/TicketsTest.php';

use runners\BaseRunner;
use test\TicketsTest;

$runner = new BaseRunner(TicketsTest::class);
