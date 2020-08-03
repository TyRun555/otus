<?php


class Test
{
    const CASES_PATH = '../Tasks/';

    public $description;
    public $totalTests;
    public $countSuccessful;
    public $errors;


    public function run(string $taskName)
    {
        $task = $this->getTask($taskName);
        if (!$task) throw new Exception('Задание не найдено!');

        $tests = $task->getTests();
        if (empty($task)) throw new Exception("Не найдено ни одного теста по заданию !");

        $this->totalTests = count($tests);

        foreach ($tests as $test)
        {
            $this->runCase($test);
        }

    }

    private function getTask(string $taskName): array
    {
        $tests = [];
        $task = self::CASES_PATH.$taskName;
        if (file_exists($task) && is_dir($task)) {
            $dirContent =  glob($task.'/*.in');
            foreach ($dirContent as $testCase) {
                $tests[] = new TestCase($testCase);
            }
        }
        return $tests;
    }

    abstract function runCase(TestCase $test);


}