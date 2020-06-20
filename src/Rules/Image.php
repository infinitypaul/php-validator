<?php


namespace Infinitypaul\Validator\Rules;


class Image extends Rule
{
    public function passes($field, $value, $data): bool
    {
        if(getimagesize($value)){
            return true;
        };
        return false;

    }

    public function message($field): string
    {
        return $field. ' Is Not An Image';
    }
}
