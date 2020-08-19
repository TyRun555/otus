<?php
namespace test;


class FiboTest extends MultipleMethodsTest
{
    public

    function runCase(TestCase $test)
    {
        $n = (int)$test->input;
        $results = [
            $this->runMethod('byFi'),
        ];

        $this->checkResult($results, $test, true);
    }

    private function fib($n)
    {
        $SQRT5 = sqrt(5);
        $PHI = ($SQRT5 + 1) / 2;
        return $PHI ** $n / $SQRT5 + 0.5;
    }

    protected function baseCheck()
    {
        // TODO: Implement baseCheck() method.
    }

    protected function getInputVars(TestCase $testCase)
    {
        // TODO: Implement getInputVars() method.
    }
}