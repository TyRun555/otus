<?php
namespace runners;

use Exception;
use test\BaseTest;

class BaseRunner
{
    public function __construct(string $taskClass)
    {
        $task = new $taskClass();
        if (is_a($task, BaseTest::class)) {
            $task->run();
        } else {
            throw new Exception('Указанный класс не является тестом!');
        }
    }
}