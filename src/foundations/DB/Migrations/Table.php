<?php

namespace Foundations\DB\Migrations;

use DateTime;

class Table
{
    private $collumns = [];

    public function get_columns(): array {
        return $this->collumns;
    }

    public function id(string $name = 'id'): void {
        $column = new Column($name);
        $column->type('BIGINT')->unsigned()->primary_key()->auto_incriment();
        $this->collumns[] = $column;
    }

    public function string(string $name): Column {
        $column = new Column($name);
        $column->type('string');
        $this->collumns[] = $column;
        return $column;
    }

    public function integer(string $name): Column {
        $column = new Column($name);
        $column->type('INT');
        $this->collumns[] = $column;
        return $column;
    }

    public function float(string $name): Column {
        $column = new Column($name);
        $column->type('FLOAT');
        $this->collumns[] = $column;
        return $column;
    }

    public function boolean(string $name): Column {
        $column = new Column($name);
        $column->type('BOOLEAN');
        $this->collumns[] = $column;
        return $column;
    }

    public function date(string $name): Column {
        $column = new Column($name);
        $column->type('DATE');
        $this->collumns[] = $column;
        return $column;
    }

    public function dateTime(string $name): Column {
        $column = new Column($name);
        $column->type('TIMESTAMP');
        $this->collumns[] = $column;
        return $column;
    }

    public function timestamp(string $name): Column {
        $column = new Column($name);
        $column->type('TIMESTAMP');
        $this->collumns[] = $column;
        return $column;
    }

    public function timestampTz(string $name): Column {
        $column = new Column($name);
        $column->type('TIMESTAMPTZ');
        $this->collumns[] = $column;
        return $column;
    }

    public function timestamps(): void {
        $column = new Column('created_at');
        $column->type('TIMESTAMPTZ')->nullable()->default("CURRENT_TIMESTAMP");
        $this->collumns[] = $column;
        $column = new Column('updated_at');
        $column->type('TIMESTAMPTZ')->nullable()->default("CURRENT_TIMESTAMP");
        $this->collumns[] = $column;
    }
}