<?php

namespace Core;

class Database
{
    private \PDO $connection;
    private \PDOStatement $statement;

    public function __construct(array $config, string $username = 'root', string $password = 'root')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new \PDO($dsn, $username, $password, [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ]);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);

        foreach ($params as $key => $value) {
            if (is_array($value)) {
                [$val, $type] = $value;
                $this->statement->bindValue($key, $val, $type);
            } else {
                $this->statement->bindValue($key, $value);
            }
        }


        $this->statement->execute();

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }
}
