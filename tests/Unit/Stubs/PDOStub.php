<?php

namespace Stubs;

class PDOStub extends \PDO
{
    public function __construct(
        ?string $username = null,
        ?string $password = null,
        ?array $options = null
    ) {
        $port = env('DB_PORT', 3306);
        $dbHost = env('DB_HOST', 'spatial_test');
        $dbName = env('DB_DATABASE', 'spatial_test');
        $dsn = 'mysql:host=' . $dbHost . ':' . $port . ';dbname=' . $dbName;

        if (is_null($username)) {
            $username = env('DB_USERNAME');
        }

        if (is_null($password)) {
            $password = env('DB_PASSWORD');
        }
        parent::__construct($dsn, $username, $password, $options);
    }
}
