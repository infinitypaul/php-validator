<?php


namespace Infinitypaul\Validator\Rules;


abstract class Rule
{
    abstract public function passes($field, $value, $data) : bool;
    abstract public function message($field) : string;
}
