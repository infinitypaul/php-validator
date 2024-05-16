<?php

namespace Infinitypaul\Validator\Rules;

class Between extends Rule
{
    /**
     * @var int
     */
    protected $lower;
    /**
     * @var int
     */
    protected $upper;

    /**
     * Between constructor.
     *
     * @param  $lower
     * @param  $upper
     */
    public function __construct($lower, $upper)
    {
        $this->lower = $lower;
        $this->upper = $upper;
    }

    /**
     * @param  $field
     * @param  $value
     * @param  $data
     * @return bool
     */
    public function passes($field, $value, $data): bool
    {
        if (strlen($value) < (int) $this->lower) {
            return false;
        }

        if (strlen($value) > (int) $this->lower) {
            return false;
        }

        return true;
    }

    /**
     * @param  $field
     * @return string
     */
    public function message($field): string
    {
        return $field.' Must Be Between '.$this->lower.' And '.$this->upper.' Characters';
    }
}
