<?php

namespace Infinitypaul\Validator;

use Infinitypaul\Validator\Rules\Between;
use Infinitypaul\Validator\Rules\Email;
use Infinitypaul\Validator\Rules\Max;
use Infinitypaul\Validator\Rules\Optional;
use Infinitypaul\Validator\Rules\Required;
use Infinitypaul\Validator\Rules\RequiredWith;

class RuleMap
{
    /**
     * @var string[]
     */
    protected static $map = [
        'required' => Required::class,
        'email' => Email::class,
        'max' => Max::class,
        'between' => Between::class,
        'required_with'=> RequiredWith::class,
        'optional' => Optional::class,
    ];

    /**
     * @param $rule
     * @param $options
     *
     * @return mixed
     */
    public static function resolve($rule, $options)
    {
        return new static::$map[$rule](...$options);
    }
}
