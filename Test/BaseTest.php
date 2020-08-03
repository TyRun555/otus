<?php
namespace test;

use Exception;

abstract class BaseTest
{

    public $description = '';
    public $totalCases = 0;
    public $countSuccessful = 0;
    public $errors = [];
    public $cases = [];
    public $taskName = '';

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
            $this->runCase($case);
        }

        if ($this->countSuccessful == $this->totalCases) {
            echo "Все тесты успешно пройдены. \r\n";
        } else {
            echo "Успешно пройдено: $this->countSuccessful \r\n";
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
            foreach ($this->errors as $error) {
                echo "Тест не пройден!\r\n\tВход: '{$error['test_input']}'\r\n\tРезультат: '{$error['result']}'\r\n\tОжидаемый результат: - '{$error['test_expected']}'\r\n";
            }
        }
    }

    protected function error(TestCase $test, $result)
    {
        $this->errors[] = [
            'test_input' => $test->input,
            'test_expected' => $test->expectedResult,
            'result' => $result
        ];
    }

    public function getBaseCasePath()
    {
        return dirname(__DIR__).'/Tasks/';
    }

}