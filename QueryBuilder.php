<?php

class QueryBuilder
{

    private array $select = [];
    private array $from = [];
    private array $where = [];
    private array $groupBy = [];

    public function select(array $select): QueryBuilder
    {
        $this->select = $select;
        return $this;
    }

    public function from(array $from): QueryBuilder
    {
        $this->from = $from;
        return $this;
    }

    public function where(array $where): QueryBuilder
    {
        $this->where = $where;
        return $this;
    }

    public function groupBy(array $groupBy): QueryBuilder
    {
        $this->groupBy = $groupBy;
        return $this;
    }

    public function get(): string
    {
        return sprintf(
            'SELECT %s FROM %s WHERE %s GROUP BY %s',
            join(', ', $this->select),
            join(', ', $this->from),
            join(', ', ($this->where === []) ? ["1"] : $this->where),
            join(', ', ($this->groupBy === []) ? ["id"] : $this->groupBy),

        );
    }


}
