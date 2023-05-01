<?php

namespace Phattarachai\Odbc;


use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connectors\ConnectorInterface;
use Illuminate\Support\Arr;

class ODBCConnector extends Connector implements ConnectorInterface
{

    /**
     * Establish a database connection.
     *
     * @param array $config
     *
     * @return \PDO
     * @throws \Exception
     * @internal param array $options
     *
     */
    public function connect(array $config)
    {
        $options = $this->getOptions($config);

        $dsn = Arr::get($config, 'dsn');

        return $this->createConnection($dsn, $config, $options);
    }

    /**
     * Create a new PDO connection instance.
     *
     * @param string $dsn
     * @param string $username
     * @param string $password
     * @param array $options
     * @return ODBCPdo
     */
    protected function createPdoConnection($dsn, $username, $password, $options)
    {
        return new ODBCPdo($dsn, $username, $password);
    }
}
