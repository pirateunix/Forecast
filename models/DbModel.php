<?php

namespace models;

abstract class DbModel
{
    public $mdb;

    public function __construct($connect)
    {
        $this->mdb = $connect;

    }
}