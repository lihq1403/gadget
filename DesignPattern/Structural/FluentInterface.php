<?php
/**
 * 流接口模式（Fluent Interface）
 * 用来编写易于阅读的代码，就像自然语言一样（如英语）
 */


class Sql
{
    private array $fields = [];

    private array $from = [];

    private array $where = [];

    public function select(array $fields = ['*']): Sql
    {
        $this->fields = $fields;
        return $this;
    }

    public function from(string $table, string $alias): Sql
    {
        $this->from[] = $table.' AS '.$alias;

        return $this;
    }

    public function where(string $condition): Sql
    {
        $this->where[] = $condition;

        return $this;
    }

    public function getSql(): string
    {
        return sprintf(
            "SELECT %s FROM %s WHERE %s",
            join(', ', $this->fields),
            join(', ', $this->from),
            join(' AND ', $this->where)
        );
    }
}

$sql = new Sql();
$sql->select(['foo', 'bar'])
    ->from('foobar', 'f')
    ->where('f.bar = ?');

echo $sql->getSql();