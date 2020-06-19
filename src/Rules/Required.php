<?php

namespace Infinitypaul\Validator\Rules;

class Required extends Rule
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
        return ! empty($value);
    }

    /**
     * @param $field
     *
     * @return string
     */
    public function message($field): string
    {
        return $field.' Is Required';
    }
}
