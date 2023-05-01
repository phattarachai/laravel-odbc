<?php

namespace Phattarachai\Odbc;


use Illuminate\Database\Query\Builder;

class ODBCBuilder extends Builder
{
    private $model;

    public function __construct(
        $connection,
        $grammar = null,
        $processor = null,
        $model = null
    ) {
        $this->model = $model;
        return parent::__construct($connection, $grammar, $processor);
    }

    public function whereIn($column, $values, $boolean = 'and', $not = false)
    {
        return parent::whereIn($column, $values, $boolean, $not);
    }


    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        list($value, $operator) = $this->prepareValueAndOperator(
            $value, $operator, func_num_args() === 2
        );
        $value = $this->getModel()->wrapAttribute($column, $value);
        return parent::where($column, $operator, $value, $boolean);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model): void
    {
        $this->model = $model;
    }
}
