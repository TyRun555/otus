<?php


class TestCase
{

    public $casePath;
    public $expectedResult;

    public function __construct($casePath)
    {
        $this->casePath = $casePath;
        $this->expectedResult = $this->getExpectedResult();
    }


    private function getExpectedResult()
    {
        return file_get_contents(substr($this->casePath, 0, -2).'out');
    }

}