# Flexible PHP Validation Class

[![Latest Version on Packagist](https://img.shields.io/packagist/v/infinitypaul/php-validator.svg?style=flat-square)](https://packagist.org/packages/infinitypaul/php-validator)
[![Build Status](https://img.shields.io/travis/infinitypaul/php-validator/master.svg?style=flat-square)](https://travis-ci.org/infinitypaul/php-validator)
[![Quality Score](https://img.shields.io/scrutinizer/g/infinitypaul/php-validator.svg?style=flat-square)](https://scrutinizer-ci.com/g/infinitypaul/php-validator)
[![Total Downloads](https://img.shields.io/packagist/dt/infinitypaul/php-validator.svg?style=flat-square)](https://packagist.org/packages/infinitypaul/php-validator)

Provides several different approaches to validate your application's incoming data

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

### Writing The Validation Logic
We pass the field we intend to validate into the `Validator` class

```php
new Validator([
                'full_name' => 'Edward Paul',
                'email' => 'infinitypaul@live.com'
            ]);
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

So, what if the incoming  parameters do not pass the given validation rules? The errors will be able in the `getErrors()` method like  the above

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

* [Required](#required-)
* [Email](#email-)
* [Max](#max-)
* [RequiredWith](#requiredwith-)
* [Optional](#optional-)
* [Between](#between-)


##### Required :

The field under validation must be present in the input data and not empty.

##### Email :

The field under validation must be formatted as an e-mail address

##### Max :
The field under validation must be less than or equal to a maximum value

```
max:20
```
##### RequiredWith :

The field under validation must be present and not empty only if all of the other specified fields are present.

```
  required_with:lastName,middle
```

##### Between :

The field under validation must have a size between the given min and max

```
between:10,20
```

##### Optional :

The field under validation may be null. This is particularly useful when validating primitive such as strings and integers that can contain null values.

```
optional
```

### Note

I intend to keep adding more rules to the package but If you have any additional rules you will like me to add to this, you can reach out to me or open an issue in that regard.

## How can I thank you?

Why not star the github repo? I'd love the attention! Why not share the link for this repository on Twitter or HackerNews? Spread the word!

Don't forget to [follow me on twitter](https://twitter.com/infinitypaul) || [or on medium](https://medium.com/@infinitypaul)

Thanks!
Edward Paul.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Bug & Features

If you have spotted any bugs, or would like to request additional features from the library, please file an issue via the Issue Tracker on the project's Github page: [https://github.com/infinitypaul/php-validator/issues](https://github.com/infinitypaul/php-validator/issues).


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

