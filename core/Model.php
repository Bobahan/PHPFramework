<?php

namespace PHPFramework;

use Valitron\Validator;

class Model
{
    // все свойства будут приходить извне !!!
    protected string $table;
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
        foreach($this->fillable as $field) {
            isset($data[$field]) ? $this->attributes[$field] = $data[$field] : '';
        }
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