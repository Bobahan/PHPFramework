<?php

namespace PHPFramework;

use Valitron\Validator;

class Model
{
    // все свойства будут приходить извне !!!
    protected string $table;
    public bool $timestamps = false;
    protected array $loaded = [];
    protected array $fillable = []; // указывает какие фиксированные поля из формы мы хотим принимать. Это для того чтобы пользователь не смог подделать поля формы
    public array $attributes = []; // сюда будем записывать разрешенные атрибуты из $fillable
    protected array $rules = [];
    protected array $errors = [];

    public function loadData(): void
    {
        $data = request()->getData();

        // например у нас есть только два поля email, name, но мы каким-то образом еще получили lastname, age
        // проходимся по разрешенным атрибутам
        // и нам нужно проверять и извлекать только существующие и совпадающие поля и сохранять их в $attributes
        foreach ($this->loaded as $field) {
            if (isset($data[$field])) {
                $this->attributes[$field] = $data[$field];
            } else {
                $this->attributes[$field] = '';
            }
        }
    }

    public function save()
    {
        foreach($this->attributes as $key => $value) {
            if(!in_array($key, $this->fillable)) {
                unset($this->attributes[$key]);
            }
        }

        $keys = implode(', ', array_keys($this->attributes));
        $values = implode(', ', array_map(fn ($value) => ":$value",explode(', ' , $keys)));

        $query = "INSERT INTO $this->table ($keys) VALUES ($values)";

        database()->query($query, $this->attributes);

        return database()->getLastInsertedId();
    }

    public function validate($data = [], $rules = []): bool
    {
        if(empty($data)) {
            $data = $this->attributes;
        }

        if(empty($rules)) {
            $rules = $this->rules;
        }

        $validator = new Validator($data);

        $validator->rules($rules);

        if($validator->validate()) {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}