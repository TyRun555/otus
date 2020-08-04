<?php
//TODO сделать генерацию autoload файла
$spells = glob(__DIR__ . '/Spell*.php');

foreach ($spells as $spell) {
    require_once $spell;
}
