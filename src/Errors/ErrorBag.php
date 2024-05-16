<?php

namespace Infinitypaul\Validator\Errors;

class ErrorBag
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @param  $key
     * @param  $value
     */
    public function add($key, $value)
    {
        $this->errors[$key][] = $value;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /*
     *  Check If Errors Exist
     */
    public function hasErrors(): bool
    {
        return empty($this->errors);
    }
}
