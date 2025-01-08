<?php 

namespace app\core;

class Database 
{
    public function store(string $table, $params)
    {
        dd($params);
    }

    public function all(string $table)
    {
        return [
            "title" => "My First Post",
            "content" => "The content of my first post"
        ];
    }
}