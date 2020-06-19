<?php

namespace Infinitypaul\Validator\Rules;

class Email extends Rule
{
    /**
     * @param $field
     * @param $value
     *
     * @param $data
     *
     * @return bool
     */
    public function passes($field, $value, $data): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $field
     *
     * @return string
     */
    public function message($field): string
    {
        return $field.' Must Be A Valid Email Address';
    }
}
