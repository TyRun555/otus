<?php
namespace hps;

use Exception;

class Spell
{
    public $spell;
    public $mark = "# ";
    public $space = ". ";

    public function run()
    {
        if (empty($this->spell)) throw new Exception('Пустое заклинание!');
        for ($x = 0; $x < 25; $x++) {
            for ($y = 0; $y < 25; $y++) {
                $isMark = eval($this->spell);
                if (!is_bool($isMark)) throw new Exception('Тип результата заклинания не boolean!');
                echo $isMark ? $this->mark : $this->space;
            }
            echo "\r\n";
        }
    }
}