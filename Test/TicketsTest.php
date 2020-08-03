<?php
namespace test;

class TicketsTest extends BaseTest
{

    public $taskName = '1.Tickets';

    function runCase(TestCase $test): void
    {
        $n = strlen($test->input);
        $result = 0;
        $ranges = [];

        for ($i = 1; $i <= $n; $i++) {
            $ranges[] = range(0, 9);
        }
        if (!empty($ranges)) {
            foreach ($ranges as $k => $range) {
                foreach ($range[$k] as $digit) {
                    $halfTicket = $digit;
                    if (isset($range[$n-$k])) {
                        foreach ($range[$n-$k] as $nextDigit) {
                            $halfTicket .= $nextDigit;
                        }
                    } else {
                        $tickets[] = $halfTicket;
                        $halfTicket = '';
                    }
                }
            }
            foreach ($tickets as $leftHalfTicket) {
                foreach ($tickets as $rightHalfTicket) {
                    $left = str_split($leftHalfTicket);
                    $right = str_split($rightHalfTicket);
                    if (array_sum($left) === array_sum($right)) {
                        $result++;
                    }
                }
            }
        }

        if ($result === $test->expectedResult) {
            $this->countSuccessful++;
        } else {
            $this->error($test, $result);
        }

    }

    private function isLucky(string $num)
    {
        $ar = str_split($num, strlen($num)/2);
        $left = str_split($ar[0]);
        $right = str_split($ar[1]);

    }
}