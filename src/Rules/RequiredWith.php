<?php

namespace Infinitypaul\Validator\Rules;

use Infinitypaul\Validator\Validator;

class RequiredWith extends Rule
{
    /**
     * @var array
     */
    protected $fields;

    public function __construct(...$fields)
    {
        $this->fields = $fields;
    }

    public function passes($field, $value, $data): bool
    {
        foreach ($this->fields as $field) {
            if ($value === '' && $data[$field] !== '') {
                return false;
            }
        }

        return true;
    }

    public function message($field): string
    {
        return $field.' Is Required With '.implode(',', Validator::aliases($this->fields));
    }
}
