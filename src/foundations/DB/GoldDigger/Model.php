<?php

namespace Foundations\DB\GoldDigger;

use Foundations\DB\GoldDigger\Relationships\BelongsTo;
use Foundations\DB\GoldDigger\Relationships\BelongsToMany;
use Foundations\DB\GoldDigger\Relationships\HasMany;
use Foundations\DB\GoldDigger\Relationships\HasOne;

class Model{
    protected static ?string $table = null;
    public array $attributes = [];

    public array $relationships = [];

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    public static function class_basename(string $class): string
    {
        return basename(str_replace('\\', '/', $class));
    }

    public static function pluralize(string $name): string
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
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        if (isset($this->relationships[$key])) {
            return $this->relationships[$key];
        }

        if (method_exists($this, $key)) {
            $this->relationships[$key] = $this->{$key}()->get();
            return $this->relationships[$key];
        }

        return null;
    }

    public function __set(string $key, $value): void
    {
        $this->attributes[$key] = $value;
    }

    public function __debugInfo(): array
    {
        return array_merge(
            $this->attributes,
            $this->relationships ?: []
        );
    }
    
    public function load(string $key): self
    {
        $this->relationships[$key] = $this->{$key}()->get();
        return $this;
    }

    public static function with(string $key): QueryBuilder{
        return static::query()->with($key);
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
        $query = static::query()->update($attributes);
        foreach ($wheres as $key => $value) {
            $query->where($key, "=", $value);
        }
        return $query->get();
    }

    public static function delete(array $wheres){
        $query = static::query();
        foreach ($wheres as $key => $value) {
            $query->where($key, "=", $value);
        }
        return $query->get();
    }

    public static function all(){
        return static::query()->get();
    }

    public static function find(int $id): ?static
    {
        return static::query()->where('id', "=", $id)->first();
    }

    public static function findOrFail(int $id): ?static
    {
        return static::query()->where('id', "=", $id)->first() ?? abort(404, "{$id} not found");
    }

    public static function findOrInit(int $id): ?static
    {
        return static::query()->where('id', "=", $id)->first() ?? new static();
    }

    public static function findOrCreate(array $attributes): static
    {
        $query = static::query();
        foreach ($attributes as $key => $value) {
            $query->where($key, "=", $value);
        }
        return $query->first() ?? static::create($attributes);
    }

    public static function last(int $id): ?static
    {
        return static::query()->where('id', "=", $id)->last();
    }

    public static function lastOrFail(int $id): ?static {
        return static::query()->where('id', "=", $id)->last() ?? abort(404, "{$id} not found");;
    }

    public static function lastOrInit(int $id): ?static {
        return static::query()->where('id', "=", $id)->last() ?? new static();
    }

    public static function lastOrCreate(array $attributes): static
    {
        $query = static::query();
        foreach ($attributes as $key => $value) {
            $query->where($key, "=", $value);
        }
        return $query->last() ?? static::create($attributes);
    }

    public function belongsTo($related, $foreignKey = null, $localKey = 'id'){
        return new BelongsTo($related, $this, $localKey, $foreignKey ?? strtolower(Model::class_basename($related)) . '_id');
    }

    public function belongsToMany($related, $pivot_table = null, $localKey = 'id', $foreignKey = null, $relatedLocalKey = 'id', $relatedForeignKey = null){
        //Role::class, 'role_user', 'user_id', 'role_id'
        $relatedClassName = strtolower(Model::class_basename($related));
        $parrentClassName = strtolower(Model::class_basename($this::class));
        if(is_null($pivot_table)){
            $modelNamesArr = [$relatedClassName, $parrentClassName];
            sort($modelNamesArr);
            $pivot_table = implode('_', $modelNamesArr);
        }

        $foreignKey ??= $parrentClassName . '_id';
        $relatedForeignKey ??= $relatedClassName . '_id';
        
        return new BelongsToMany($related, $pivot_table, $this, $localKey, $foreignKey, $relatedLocalKey, $relatedForeignKey);
    }

    public function hasOne($related, $foreignKey = null, $localKey = 'id'){
        return new HasOne($related, $this, $localKey, $foreignKey ?? strtolower(Model::class_basename($related)) . '_id');
    }

    public function hasMany($related, $foreignKey = null, $localKey = 'id'){
        return new HasMany($related, $this, $localKey, $foreignKey);
    }
}