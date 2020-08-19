<?php

namespace test;

class StringTest extends BaseTest
{
    public $taskName = '0.String';

    function runCase(TestCase $testCase): bool
    {
        $result = new Result('Подсчет кол-ва символов', $this->strlen($testCase->input));
        return $this->checkResult($result, $testCase);
    }

    private function strlen(string $string)
    {
        if ($string == '') {
            return 0;
        }
        $array = str_split($string);
        return count($array);
    }

    protected function getInputVars(TestCase $testCase)
    {
        // TODO: Implement getInputVars() method.
    }
}