<?php

define("ROOT", dirname(__DIR__));

const APP = ROOT . "/app";
const HELPERS = ROOT . "/helpers";
const CONFIG = ROOT . "/config";
const CORE = ROOT . "/core";
const VIEWS = APP . "/Views";
const COMPONENT = "default";
const PATH = "http://localhost:8888";

const DB_SETTINGS = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'mvc',
    'username' => 'root',
    'password' => 'root',

    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'port' => 8889,
    'prefix' => '',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
];

const CACHE = ROOT . '/tmp/cache';