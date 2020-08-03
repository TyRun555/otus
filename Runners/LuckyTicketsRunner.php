<?php
require_once '../autoload.php';

use runners\BaseRunner;
use test\TicketsTest;

$runner = new BaseRunner(TicketsTest::class);
