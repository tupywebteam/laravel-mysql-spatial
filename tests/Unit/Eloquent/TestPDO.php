<?php

namespace Tests\Unit\Eloquent;

use Mockery as m;
use PDO;
use PDOStatement;

class TestPDO extends PDO
{
    public $queries = [];

    public $counter = 1;

    public function prepare(string $query, array $options = []): PDOStatement|false
    {
        $this->queries[] = $query;

        $stmt = m::mock('PDOStatement');
        $stmt->shouldReceive('bindValue')->zeroOrMoreTimes();
        $stmt->shouldReceive('execute');
        $stmt->shouldReceive('fetchAll')->andReturn([['id' => 1, 'point' => 'POINT(1 2)']]);
        $stmt->shouldReceive('rowCount')->andReturn(1);

        return $stmt;
    }

    /**
     * @param string|null $name
     * @return string|false
     */
    public function lastInsertId(?string $name = null): string|false
    {
        return $this->counter++;
    }

    public function resetQueries()
    {
        $this->queries = [];
    }
}