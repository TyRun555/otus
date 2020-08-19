<?php

namespace test;
/**
 * Алгоритмы для нахождения НОД
 * @package test
 *
 * @property int $a первое число
 * @property int $b второе число
 */
class GcdTest extends MultipleMethodsTest
{

    public $taskName = '2.GCD';
    private $a;
    private $b;
    public $compare = true;


    function runCase(TestCase $testCase): bool
    {
        $this->getInputVars($testCase);

        if ($fastCheck = $this->baseCheck()) {
            $results = [
                new Result('bySubtraction', $fastCheck),
                new Result('byModulo', $fastCheck),
                new Result('byBinary', $fastCheck),
            ];
        } else {
            $results = [
                $this->runMethod('bySubtraction', [$this->a, $this->b]),
                $this->runMethod('byModulo', [$this->a, $this->b]),
                $this->runMethod('byBinary', [$this->a, $this->b])
            ];
        }

        return $this->checkResult($results, $testCase, true);

    }

    protected function bySubtraction($a, $b)
    {
        while ($a !== $b) {
            if ($a > $b) {
                $a = $a - $b;
            } else {
                $b = $b - $a;
            }
        }
        return $a;
    }

    protected function byModulo($a, $b)
    {
        if($b === 0) {return $a;}
        return $this->byModulo($b, $a % $b);
    }

    protected function byBinary($a, $b)
    {
        if ($a === $b) {
            return $a;
        }

        if ($a === 0) {
            return $b;
        }

        if ($b === 0) {
            return $a;
        }

        // 2 варианта
        if (~$a & 1) // $a четное
            if ($b & 1) {// $b нечетное
                return $this->byBinary($a >> 1, $b);
            } else {// оба числа - четные
                return $this->byBinary($a >> 1, $b >> 1) << 1;
            }

        if (~$b & 1) {// $a не четное, $b четное
            return $this->byBinary($a, $b >> 1);
        }

        // Уменьшаем наибольший аргумент
        if ($a > $b) {
            return $this->byBinary(($a - $b) >> 1, $b);
        }

        return $this->byBinary(($b - $a) >> 1, $a);
    }

    /**
     * Базовая проверка для всех алгоритмов, для простых случаев
     * @return int
     */
    protected function baseCheck()
    {

        if ($this->a === false || $this->b === false) {
            return 'Входные значение превышают максимальную величину для int!';
        }

        if ($this->a === $this->b) {
            return $this->a;
        }

        if ($this->a === 0) {
            return $this->b;
        }

        if ($this->b === 0) {
            return $this->a;
        }

        if ($this->a === 1 || $this->b === 1) {
            return 1;
        }

        return false;
    }

    protected function getInputVars(TestCase $testCase)
    {
        list($a, $b) = explode(PHP_EOL, $testCase->input);
        if (!is_int((int)$a + 1) || !is_int((int)$b + 1)) { //слишком большое число для int :-(
            $this->a = false;
            $this->b = false;
        } else {
            $this->a = (int)trim($a);
            $this->b = (int)trim($b);
        }
    }
}