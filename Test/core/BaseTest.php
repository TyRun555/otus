<?php

namespace test;

use Exception;

/**
 * Class BaseTest
 * @package test
 *
 * @property string $description Описание задания
 * @property int $totalCases Суммарное количество тестов
 * @property int $countSuccessful Количество успешно пройденных тестов
 * @property array $errors Массив проваленных тестов, каждый элемент содержит в себе входящие данные,
 * результат и ожидаемый результат
 * @property array $cases массив с объектами представляющими конкретный тест
 * @property string $taskName Название папки с заданием и тестами
 * @property array $totalRunTime Массив с суммарным временем выполнения для каждого из выполненных алгоритмов.
 * ключи - код метода, значения - время выполнения в секундах
 */
abstract class BaseTest
{

    public $description = '';
    public $totalCases = 0;
    public $countSuccessful = 0;
    public $errors = [];
    public $cases = [];
    public $taskName = '';
    public $totalRunTime = [];

    public function __construct($taskName = null)
    {
        $taskName = $this->taskName ?? $taskName;
        if (!$taskName) throw new Exception('Не указано название задания!');
        $this->getTask($taskName);
        if (empty($this->cases)) throw new Exception("Не найдено ни одного теста по заданию !");
    }

    public function run(): void
    {
        echo $this->description . "\r\n";

        echo "Всего тестов: {$this->totalCases}\r\n";

        foreach ($this->cases as $case) {
            echo "Запуск теста $case->caseName ...";
            if ($this->runCase($case)) {
                echo "\033[01;32m OK \033[0m" . PHP_EOL;
            } else {
                echo "\033[01;31m FAIL \033[0m" . PHP_EOL;
            }

        }

        if ($this->countSuccessful == $this->totalCases) {
            echo "\033[01;32mВсе тесты успешно пройдены. \033[0m". PHP_EOL;
        } else {
            echo "Успешно пройдено: $this->countSuccessful". PHP_EOL. PHP_EOL;
            $this->printErrors();
        }

    }

    private function getTask(string $taskName): void
    {
        $taskPath = $this->getBaseCasePath() . $taskName;
        if (file_exists($taskPath) && is_dir($taskPath)) {
            $dirContent = glob($taskPath . '/*.in');
            $this->cases = $this->getTestCases($dirContent);
            $this->totalCases = count($this->cases);
            $this->description = $this->getDescription($taskPath);
        }
    }

    public function getTestCases(array $dirContent): array
    {
        $testCases = [];
        if (is_array($dirContent)) {
            foreach ($dirContent as $testCase) {
                $testCases[] = new TestCase($testCase);
            }
        }
        return $testCases;

    }

    private function getDescription(string $taskPath): string
    {
        $description = '';
        $descriptionPath = $taskPath . DIRECTORY_SEPARATOR . 'problem.txt';
        if (file_exists($descriptionPath)) {
            $description = file_get_contents($descriptionPath);
        }
        return $description;
    }

    abstract function runCase(TestCase $test);

    private function printErrors()
    {
        if (is_array($this->errors)) {
            echo "Проваленные тесты:";
            foreach ($this->errors as $error) {
                $error->print();
            }
        }
    }

    protected function error(TestCase $testCase, Result $result)
    {
        $this->errors[] = new Fail($testCase, $result);
    }

    public function getBaseCasePath()
    {
        return dirname(dirname(__DIR__)) . '/Tasks/';
    }

    /**
     * Проверяем результат, увеличиваем число пройденных тестов либо добавляем ошибку
     * @param mixed $result
     * @param TestCase $test
     * @param bool $multiple
     * @return bool
     */
    protected function checkResult($result, TestCase $test, bool $multiple = false): bool
    {
        $checkResult = $multiple ? $this->checkMultiple($result, $test) : $this->checkSingle($result, $test);
        if ($checkResult) {
            $this->countSuccessful++;
            return true;
        }
        return false;
    }

    private function checkSingle(Result $result, TestCase $test)
    {

        if ($result->value == $test->expectedResult) {
            return true;
        }

        $this->error($test, $result);
        return false;
    }

    private function checkMultiple(array $results, TestCase $test)
    {
        $success = true;
        foreach ($results as $code => $result) {
            if (!$this->checkSingle($result, $test)) {
                $success = false;
            }
        }
        return $success;
    }

    protected abstract function getInputVars(TestCase $testCase);
}