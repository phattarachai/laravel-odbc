<?php

namespace Phattarachai\Odbc;

use Illuminate\Database\Connection;
use Illuminate\Database\Events\StatementPrepared;
use PDOStatement;

class ODBCConnection extends Connection
{
    public function getDefaultQueryGrammar()
    {
        $queryGrammar = $this->getConfig('options.grammar.query');
        if ($queryGrammar) {
            return new $queryGrammar;
        }
        return parent::getDefaultQueryGrammar();
    }

    public function getDefaultSchemaGrammar()
    {
        $schemaGrammar = $this->getConfig('options.grammar.schema');
        if ($schemaGrammar) {
            return new $schemaGrammar;
        }
        return parent::getDefaultSchemaGrammar();
    }

    protected function getDefaultPostProcessor(): ODBCProcessor
    {
        $processor = $this->getConfig('options.processor');
        if ($processor) {
            return new $processor;
        }
        return new ODBCProcessor;
    }

    protected function prepared(PDOStatement $statement)
    {
        // $statement->setFetchMode($this->fetchMode);

        $this->event(new StatementPrepared($this, $statement));

        return $statement;
    }
}
