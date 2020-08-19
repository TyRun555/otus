<?php

namespace test;

class TicketsTest extends BaseTest
{

    public $taskName = '1.Tickets';

    function runCase(TestCase $test): bool
    {

        $n = (int)$test->input;
        $result = new Result(null, $this->countLuckyTicketFast($n));
        return $this->checkResult($result, $test);

    }

    private function getTicketsArray($n)
    {
        $ticketsArray = array();
        for ($i = 1; $i <= $n; $i++) {
            $iLength = $i * 9 + 1;
            if ($i == 1) {
                for ($j = 0; $j < $iLength; $j++) {
                    $ticketsArray[$i][$j] = 1;
                }
            } else {
                $iSum = 0;
                for ($k = 0; $k <= $iLength / 2; $k++) {
                    $iSum += $ticketsArray[$i - 1][$k];
                    if ($k >= 10)
                        $iSum -= $ticketsArray[$i - 1][$k - 10];
                    $ticketsArray[$i][$k] = $iSum;
                }
                for ($s = $k; $s < $iLength; $s++) {
                    $ticketsArray[$i][$s] = $ticketsArray[$i][$iLength - 1 - $s];
                }
            }
        }
        return $ticketsArray;
    }

    private function countLuckyTicketFast($n)
    {
        $ticketsArray = $this->getTicketsArray($n);
        $iCount = 0;
        for ($i = 0; $i <= $n * 9; $i++) {
            $iCount = ($iCount + $ticketsArray[$n][$i] * $ticketsArray[$n][$i]);
        }
        return $iCount;
    }

    protected function getInputVars(TestCase $testCase)
    {
        // TODO: Implement getInputVars() method.
    }
}