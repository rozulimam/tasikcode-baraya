<?php

use Dotenv\Dotenv;

class Env
{
    public function init()
    {
        $dotenv = Dotenv::createImmutable(".");
        $dotenv->load();
    }
}
