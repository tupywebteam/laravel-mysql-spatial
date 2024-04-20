<?php

namespace Tests\Unit\Connectors;

use Grimzy\LaravelMysqlSpatial\Connectors\ConnectionFactory;
use Grimzy\LaravelMysqlSpatial\MysqlConnection;
use Illuminate\Container\Container;
use Illuminate\Database\PostgresConnection;
use Mockery;
use Tests\Unit\BaseTestCase;
use Tests\Unit\Stubs\PDOStub;

class ConnectionFactoryTest extends BaseTestCase
{
    public function testMakeCallsCreateConnection()
    {
        $pdo = new PDOStub();

        $factory = Mockery::mock(ConnectionFactory::class, [new Container()])->makePartial();
        $factory->shouldAllowMockingProtectedMethods();
        $conn = $factory->createConnection('mysql', $pdo, 'database');

        $this->assertInstanceOf(MysqlConnection::class, $conn);
    }

    public function testCreateConnectionDifferentDriver()
    {
        $pdo = new PDOStub();

        $factory = Mockery::mock(ConnectionFactory::class, [new Container()])->makePartial();
        $factory->shouldAllowMockingProtectedMethods();
        $conn = $factory->createConnection('pgsql', $pdo, 'database');

        $this->assertInstanceOf(PostgresConnection::class, $conn);
    }
}
