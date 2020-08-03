<?php
namespace test;

class TicketsTest extends BaseTest
{

    public $taskName = '1.Tickets';

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