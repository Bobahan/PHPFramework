<?php

namespace App\Models;

use PHPFramework\Model;

class User extends Model
{
    protected string $table = 'users';
    protected array $loaded = ['name', 'email', 'password', 'confirmPassword'];
    protected array $fillable = ['name', 'email', 'password']; // данный массив $fillable  переопределяет и заполняет массив Родительского Класса

    // правило валидации => в массиве указываем те поля которые должны провалидировать
    public array $rules = [ // данный массив $rules переопределяет и заполняет массив Родительского Класса
        'required' => ['name', 'email', 'password', 'confirmPassword'],
        'email' => ['email'],
        'lengthMin' => [
            ['password', 6]
        ],
        'equals' => [
            ['password', 'confirmPassword']
        ]
    ];
}