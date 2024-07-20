<?php
declare(strict_types=1);

class DB
{
    public static function connect(): PDO
    {
        return new PDO('mysql:host=127.0.0.1;dbname=todo_app', 'root', '');
    }
}
