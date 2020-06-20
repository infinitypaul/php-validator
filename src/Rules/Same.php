<?php

namespace Infinitypaul\Validator\Rules;

use Infinitypaul\Validator\Validator;

class Same extends Rule
{
    protected $field;

    /**
     * Same constructor.
     *
     * @param $field
     */
    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * @param $field
     * @param $value
     * @param $data
     *
     * @return bool
     */
    public function passes($field, $value, $data): bool
    {
        if ($value === $data[$this->field]) {
            return true;
        }

        return false;
    }

    /**
     * @param $field
     *
     * @return string
     */
    public function message($field): string
    {
        return $field.' Doesnt Match With '.Validator::alias($this->field);
    }
}
