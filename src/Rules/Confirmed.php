<?php


namespace Infinitypaul\Validator\Rules;


class Confirmed extends Rule
{

    public function passes($field, $value, $data): bool
    {
        if(!isset($data[$field.'_confirmation'])){
            return false;
        }
        if($data[$field.'_confirmation'] !== $value){
            return false;
        };

        return true;
    }

    public function message($field): string
    {
        return $field.' Doesnt Match';
    }
}
