<?php
namespace test;

use Exception;

/**
 * Class BaseTest
 * @package test
 *
 * @property bool $compare Выводить ли таблицу сравнения (если алгоритм выполнения теста имеет несколько вариантов)
 */
abstract class MultipleMethodsTest extends BaseTest
{

    public $compare = false;

    public function run(): void
    {
        parent::run();
        if ($this->compare) {
            $this->compare();
        }

    }

    protected function runMethod(string $method, array $args): Result
    {
        if (!method_exists($this, $method)) {
            throw new Exception('Попытка запустить несуществующий вариант алгоритма!');
        }

        $result = new Result($method, null);

        $result->start();
        $value = $this->$method(...$args);
        $result->finish();

        $result->value = $value;

        if (!isset($this->totalRunTime[$method])) {
            $this->totalRunTime[$method] = 0;
        }
        $this->totalRunTime[$method] += $result->runTime;

        return $result;
    }

    protected function compare(): void
    {
        echo "Время работы алгоритмов". PHP_EOL;
        foreach ($this->totalRunTime as $method => $runTime) {
            $runTime *= 1000000; //микросекунды
            echo "\t{$method}: {$runTime}". PHP_EOL;
        }
    }

    protected abstract function baseCheck();

    protected abstract function getInputVars(TestCase $testCase);



}