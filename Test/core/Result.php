<?php


namespace test;

/**
 * Для хранения свойств результата
 * @package test
 */
class Result
{
    public $value;
    public $runTime;
    public $method;
    public $startTimestamp;

    public function __construct(?string $method, ?string $value)
    {
        $this->value = $value;
        $this->method = $method;
    }

    private function addRunTime(float $add): void
    {
        $this->runTime = $this->runTime ? $this->runTime + $add : $add;
    }

    public function start()
    {
        $this->startTimestamp = microtime(true);
    }

    public function finish()
    {
        $this->runTime = microtime(true) - $this->startTimestamp;
    }
}