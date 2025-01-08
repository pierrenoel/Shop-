<?php 

namespace app\core;

class Request
{
    public function get() : array
    {
        return $_POST;
    }
}