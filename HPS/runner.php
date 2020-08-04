<?php
namespace hps;
require_once __DIR__ . '/autoload.php';

$spell = 'hps\\Spell'.$argv[1];
$hps = new $spell();
$hps->run();


