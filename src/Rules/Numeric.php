<?php

namespace Infinitypaul\Validator\Rules;

class Numeric extends Rule
{
    /**
     * @param $field
     * @param $value
     * @param $data
     *
     * @return bool
     */
    public function passes($field, $value, $data): bool
    {
        return is_numeric($value);
    }

    /**
     * @param $field
     *
     * @return string
     */
    public function message($field): string
    {
        return $field.' Is Not A Number';
    }
}
