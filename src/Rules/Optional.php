<?php

namespace Infinitypaul\Validator\Rules;

class Optional extends Rule
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
        return true;
    }

    /**
     * @param $field
     *
     * @return string
     */
    public function message($field): string
    {
        return '';
    }
}
