<?php

namespace Phattarachai\Odbc;

use Illuminate\Database\Connection;

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
}
