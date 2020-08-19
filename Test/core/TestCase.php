<?php
namespace test;

use Exception;

class TestCase
{

    public $inputPath;
    public $caseName;
    public $input;
    public $expectedResult;

    public function __construct($casePath)
    {
        if (empty($casePath) || !file_exists($casePath)) throw new Exception('Не указан тестовый случай!');
        $this->inputPath = $casePath;
        $this->caseName = $this->getCaseName();
        $this->input = trim(file_get_contents($casePath));
        $this->expectedResult = $this->getExpectedResult();
    }


    private function getExpectedResult()
    {
        return trim(file_get_contents(substr($this->inputPath, 0, -2).'out'));
    }

    public function getCaseName()
    {
        $pathArray = explode('/', $this->inputPath);
        $caseName = array_pop($pathArray);
        unset($pathArray);
        return substr($caseName, 0, -3);
    }


}