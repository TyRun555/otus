<?php


namespace test;

/**
 * Для хранения свойств результата
 * @package test
 */
class Fail
{
    public $result;
    public $testCase;

    public function __construct(TestCase $testCase, Result $result)
    {
        $this->testCase = $testCase;
        $this->result = $result;
    }

    public function print()
    {
        echo PHP_EOL;
        echo "Алгоритм: " . $this->result->method . PHP_EOL;
        echo "Тест '{$this->testCase->caseName}' не пройден!". PHP_EOL;
        echo "\tВход: '{$this->testCase->input}'". PHP_EOL;
        echo "\tРезультат: '{$this->result->value}'". PHP_EOL;
        echo "\tОжидаемый результат: '{$this->testCase->expectedResult}'". PHP_EOL;
    }
}