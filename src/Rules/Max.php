<?php

namespace Infinitypaul\Validator\Rules;

class Max extends Rule
{
    /**
     * @var int
     */
    protected $max;

    /**
     * Max constructor.
     *
     * @param  $max
     */
    public function __construct($max)
    {
        $this->max = $max;
    }

    /**
     * @param  $field
     * @param  $value
     * @param  $data
     * @return bool
     */
    public function passes($field, $value, $data): bool
    {
        return strlen($value) <= $this->max;
    }

    /**
     * @param  $field
     * @return string
     */
    public function message($field): string
    {
        return $field.' Must Be A Max Of '.$this->max.' Characters';
    }
}
