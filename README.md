# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/infinitypaul/php-validator.svg?style=flat-square)](https://packagist.org/packages/infinitypaul/php-validator)
[![Build Status](https://img.shields.io/travis/infinitypaul/php-validator/master.svg?style=flat-square)](https://travis-ci.org/infinitypaul/php-validator)
[![Quality Score](https://img.shields.io/scrutinizer/g/infinitypaul/php-validator.svg?style=flat-square)](https://scrutinizer-ci.com/g/infinitypaul/php-validator)
[![Total Downloads](https://img.shields.io/packagist/dt/infinitypaul/php-validator.svg?style=flat-square)](https://packagist.org/packages/infinitypaul/php-validator)

It provides several different approaches to validate your application's incoming data

## Installation

You can install the package via composer:

```bash
composer require infinitypaul/php-validator
```

## Basic Usage

``` php
<?php
    $validator =  new Validator([
                'full_name' => 'Edward Paul',
                'email' => 'infinitypaul@live.com'
            ]);
    
            $validator->setRules([
                'full_name' => ['required'],
                'email' => ['email']
            ]);
    
            if(!$validator->validate()){
                var_dump($validator->getErrors());
            }else {
                var_dump('Passed');
            }
>
```

### Validation Rules

we pass the desired validation rules into the `setRules()` method. Again, if the validation fails, the proper response will save in the ErrorBag. If the validation passes, our validate method returns a true statement.

```php
<?php
        $validator->setRules([
                'full_name' => ['required'],
                'email' => ['required','email']
            ]);
```

### Displaying The Validation Errors

So, what if the incoming  parameters do not pass the given validation rules? The errors will be able in the `getErrors()` method like the the above

```php
    $validator->getErrors();
```

### Validation Error Check

You may also use the `validate()` method  to quickly check if validation error messages exist. It returns boolean:

```php
    if(!$validator->validate()){
        //There is an error
        var_dump($validator->getErrors());
    }else {
        //No Error
        var_dump('Passed');
   }
```

### Customizing The Error Key

If you can enter full_name as the key to be validated and required is set, your error message comes out in this format `full_name is required` You can customize the `full_name` with the `setAliases` method.

```php
<?php
$validator->setAliases([
           'full_name' => 'Full Name',
           'email' => 'Email Address'
       ]);
```
### Validating Arrays

Validating array  doesn't have to be a pain. You may use "dot notation" to validate attributes within an array. For example, if the incoming  request contains an array field, you may validate it like so:

```php
$validator =  new Validator([
           'email' => [
               'infinitypaul@live.com',
               ''
           ]
       ]);

$validator->setRules([
           'email' => [
               'required',
               'email'
           ],
       ]);
```
You may also validate each element of an array. For example, to validate that each e-mail in a given array input field is unique, you may do the following:

```php
$validator =  new Validator([
           'user' => [
              [
                  'firstName' => ''
              ],
               [
                   'firstName' => 'Paul'
               ]
           ],
       ]);

$validator->setRules([
           'user.*.firstName' => [
               'required'
           ]
       ]);
```

### Custom Validation Rules

You may wish to specify some of your own. One method of registering custom validation rules is extending the Rule Class

Once the custom rule class has been created, we are ready to define its behavior. A rule object contains two methods: passes and message. The passes method receives the field value, name and data, and should return true or false depending on whether the attribute value is valid or not. The message method should return the validation error message that should be used when validation fails:

```php
use Infinitypaul\Validator\Rules\Rule;

class Uppercase implements Rule
{
//Determine if the validation rule passes
 public function passes($field, $value, $data): bool
    {
       return strtoupper($value) === $value;
    }
//Get the validation error message.
public function message($field): string
    {
        return $field.' Must Be Uppercase';
    }


}
```
Once the rule has been defined, you may attach it to a validator by passing an instance of the rule object with your other validation rules:

```php
$validator =  new Validator([
           'name' => 'Edward Paul',
       ]);

$validator->setRules([
           'name' => [
               new Uppercase(),
               'max:5'

           ]
       ]);
```
### Available Validation Rules

Below is a list of all available validation rules and their function

* Required
* Email
* Max
* RequiredWith
* Optional
* Between


### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email infinitypaul@live.com instead of using the issue tracker.

## Credits

- [Paul Edward](https://github.com/infinitypaul)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).
