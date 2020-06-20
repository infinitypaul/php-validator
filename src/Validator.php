<?php

namespace Infinitypaul\Validator;

use Infinitypaul\Validator\Errors\ErrorBag;
use Infinitypaul\Validator\Rules\Optional;
use Infinitypaul\Validator\Rules\Rule;

class Validator
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $rules;

    /**
     * @var \Infinitypaul\Validator\Errors\ErrorBag
     */
    protected $errors;

    /**
     * @var array
     */
    protected static $aliases = [];

    /**
     * Validator constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $this->extractWildCardData($data);
        $this->errors = new ErrorBag();
    }

    /**
     * @param array $data
     * @param string $root
     * @param array $results
     *
     * @return array
     */
    protected function extractWildCardData(array $data, $root = '', $results = []): array
    {
        foreach ($data as $key=>$value) {
            if (is_array($value)) {
                $results = array_merge($results, $this->extractWildCardData($value, $root.$key.'.'));
            } else {
                $results[$root.$key] = $value;
            }
        }

        return $results;
    }

    /**
     * @param array $rules
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     *  Loop Through The Rules.
     */
    public function validate()
    {
        foreach ($this->rules as $field=>$rules) {
            $resolved = $this->resolveRules($rules);
            foreach ($resolved as $rule) {
                $this->validateRule($field, $rule, $this->resolveRulesContainOptional($resolved));
            }
        }

        return $this->errors->hasErrors();
    }

    protected function resolveRulesContainOptional(array $rules)
    {
        foreach ($rules as $rule) {
            if ($rule instanceof Optional) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $rules
     *
     * @return array
     */
    protected function resolveRules($rules)
    {
        return array_map(function ($rule) {
            if (is_string($rule)) {
                return $this->getRuleFromString($rule);
            }

            return $rule;
        }, $rules);
    }

    /**
     * @param $rule
     *
     * @return mixed
     */
    protected function getRuleFromString($rule)
    {
        return $this->ruleFromMap(
           ($exploded = explode(':', $rule))[0],
           explode(',', end($exploded)));
    }

    /**
     * @param $rule
     * @param $options
     *
     * @return mixed
     */
    protected function ruleFromMap($rule, $options)
    {
        return RuleMap::resolve($rule, $options);
    }

    /**
     * @param $field
     * @param \Infinitypaul\Validator\Rules\Rule $rule
     * @param bool $optional
     */
    protected function validateRule($field, Rule $rule, $optional = false)
    {
        foreach ($this->getMatchingData($field) as $matchedField) {
            if (($value = $this->getFieldValue($matchedField, $this->data)) === '' && $optional) {
                continue;
            }
            $this->validateUsingRuleObject(
                $matchedField,
                $value, $rule);
        }
    }

    /**
     * @param $field
     * @param $value
     * @param \Infinitypaul\Validator\Rules\Rule $rule
     */
    protected function validateUsingRuleObject($field, $value, Rule $rule)
    {
        if (! $rule->passes($field, $value, $this->data)) {
            $this->errors->add($field, $rule->message(self::alias($field)));
        }
    }

    /**
     * @param $field
     *
     * @return array
     */
    protected function getMatchingData($field)
    {
        //Replace Asterisk With Regular Expression
        $fieldRegex = str_replace('*', '([^\.]+)', $field);
        //Take The keys for the data
        $dataKeys = array_keys($this->data);
        //Find The Value That Relate
        //return preg_grep('/^'.$fieldRegex.'/', $dataKeys);
        return preg_grep('/^'.$fieldRegex.'$/', $dataKeys);
    }

    /**
     * @param $field
     * @param $data
     *
     * @return mixed|null
     */
    protected function getFieldValue($field, $data)
    {
        return $data[$field] ?? null;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors->getErrors();
    }

    /*
     * Set Aliases
     */
    public function setAliases(array $aliases)
    {
        self::$aliases = $aliases;
    }

    public static function alias($field)
    {
        return self::$aliases[$field] ?? $field;
    }

    /**
     * @param array $fields
     *
     * @return array
     */
    public static function aliases(array $fields): array
    {
        return array_map(function ($field) {
            return self::alias($field);
        }, $fields);
    }
}
