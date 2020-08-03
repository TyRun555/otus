<?php
namespace test;

class StringTest extends BaseTest
{
    public $taskName = '0.String';

    function runCase(TestCase $test)
    {
        $result = strlen($test->input);
        if ($result == $test->expectedResult) {
            $this->countSuccessful++;
        } else {
            $this->error($test->expectedResult, $test->input, $result);
        }
    }
}