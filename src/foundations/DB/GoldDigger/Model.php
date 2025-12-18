<?php

namespace Foundations\DB\GoldDigger;

class Model{
    protected static ?string $table = null;
    public array $attributes = [];

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    private static function class_basename(string $class): string
    {
        return basename(str_replace('\\', '/', $class));
    }

    protected static function pluralize(string $name): string
    {
        return match (true) {
            str_ends_with($name, 'y') => substr($name, 0, -1) . 'ies',
            str_ends_with($name, 's') => "{$name}es",
            default => "{$name}s",
        };
    }

    public static function table(): string
    {
        if (static::$table) {
            return static::$table;
        }

        $class = static::class_basename(static::class);

        return strtolower(static::pluralize($class));
    }

    public function fill(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function __get(string $key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function __set(string $key, $value): void
    {
        $this->attributes[$key] = $value;
    }

    public static function query(): QueryBuilder
    {
        return new QueryBuilder(static::class);
    }

    public function save(): void
    {
        static::query()->save($this);
    }

    public static function create(array $attributes): static
    {
        $model = new static($attributes);
        $model->save();
        $model = $model->query()->first();
        return $model;
    }

    public static function update(array $wheres, array $attributes){
        return static::query()->update($attributes)->where($wheres)->get();
    }

    public static function delete(array $wheres){
        return static::query()->delete()->where($wheres)->get();
    }

    public static function find(int $id): ?static
    {
        return static::query()->where('id', $id)->first();
    }

    public static function findOrFail(int $id): ?static
    {
        return static::query()->where('id', $id)->first() ?? abort(404, "{$id} not found");
    }

    public static function findOrInit(int $id): ?static
    {
        return static::query()->where('id', $id)->first() ?? new static();
    }

    public static function findOrCreate(array $attributes): static
    {
        return static::query()->where($attributes)->first() ?? static::create($attributes);
    }

    public static function last(int $id): ?static
    {
        return static::query()->where('id', $id)->last();
    }

    public static function lastOrFail(int $id): ?static {
        return static::query()->where('id', $id)->last() ?? abort(404, "{$id} not found");;
    }
}