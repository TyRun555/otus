<?php
namespace test;

use Exception;

class TestCase
{

    public $inputPath;
    public $input;
    public $expectedResult;

    public function __construct($casePath)
    {
        if (empty($casePath) || !file_exists($casePath)) throw new Exception('Не указан тестовый случай!');
        $this->inputPath = $casePath;
        $this->input = trim(file_get_contents($casePath));
        $this->expectedResult = $this->getExpectedResult();
    }


    private function getExpectedResult()
    {
        return file_get_contents(substr($this->inputPath, 0, -2).'out');
    }

}