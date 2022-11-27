<?php

namespace Phattarachai\ODBC;


use Illuminate\Database\DatabaseManager;
use Illuminate\Support\ServiceProvider;

class ODBCServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->resolving('db', function (DatabaseManager $db) {

            $db->extend('odbc', function ($config) {
                $pdoConnection = (new ODBCConnector())->connect($config);
                return new ODBCConnection($pdoConnection, $config['database'], $config['prefix'] ?? '', $config);
            });

        });
    }

    public function boot()
    {
//        Model::setConnectionResolver($this->app['db']);
//        Model::setEventDispatcher($this->app['events']);
    }
}
