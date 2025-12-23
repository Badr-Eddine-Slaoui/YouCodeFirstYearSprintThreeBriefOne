<?php

namespace Foundations\DB\Migrations;

use DateTime;

class Table
{
    private array $collumns = [];

    public function get_columns(): array {
        return $this->collumns;
    }

    public function id(string $name = 'id'): void {
        $column = new Column($name);
        $column->type('BIGINT')->unsigned()->primary_key()->auto_increment();
        $this->collumns[] = $column;
    }

    public function string(string $name): Column {
        $column = new Column($name);
        $column->type('string');
        $this->collumns[] = $column;
        return $column;
    }

    public function char(string $name): Column {
        $column = new Column($name);
        $column->type('CHAR');
        $this->collumns[] = $column;
        return $column;
    }

    public function integer(string $name): Column {
        $column = new Column($name);
        $column->type('INT');
        $this->collumns[] = $column;
        return $column;
    }

    public function bigInt(string $name): Column {
        $column = new Column($name);
        $column->type('BIGINT');
        $this->collumns[] = $column;
        return $column;
    }

    public function tinyInt(string $name): Column {
        $column = new Column($name);
        $column->type('TINYINT');
        $this->collumns[] = $column;
        return $column;
    }

    public function float(string $name): Column {
        $column = new Column($name);
        $column->type('FLOAT');
        $this->collumns[] = $column;
        return $column;
    }

    public function double(string $name): Column {
        $column = new Column($name);
        $column->type('DOUBLE');
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

    public function time(string $name): Column {
        $column = new Column($name);
        $column->type('TIME');
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

    public function text(string $name): Column {
        $column = new Column($name);
        $column->type('TEXT');
        $this->collumns[] = $column;
        return $column;
    }

    public function enum(string $name, array $values): Column {
        $column = new Column($name);
        $column->type('ENUM(' . implode(',', $values) . ')');
        $this->collumns[] = $column;
        return $column;
    }

    public function rememberToken(string $name = 'remember_token'): void {
        $column = new Column($name);
        $column->type('string')->nullable();
        $this->collumns[] = $column;
    }

    public function softDelete(string $name = 'deleted_at'): void {
        $column = new Column($name);
        $column->type('TIMESTAMP')->nullable();
        $this->collumns[] = $column;
    }

    public function foreignKey(string $name): Column {
        $column = new Column($name);
        $column->type("FOREIGN KEY($name)");
        $this->collumns[] = $column;
        return $column;
    }
}