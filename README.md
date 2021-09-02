# Computed Properties

<p align="center">
    <a href="https://github.com/ryangjchandler/computed-properties/actions"><img alt="GitHub Workflow Status (main)" src="https://img.shields.io/github/workflow/status/ryangjchandler/computed-properties/Tests/main"></a>
    <a href="https://packagist.org/packages/ryangjchandler/computed-properties"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/ryangjchandler/computed-properties"></a>
    <a href="https://packagist.org/packages/ryangjchandler/computed-properties"><img alt="Latest Version" src="https://img.shields.io/packagist/v/ryangjchandler/computed-properties"></a>
    <a href="https://packagist.org/packages/ryangjchandler/computed-properties"><img alt="License" src="https://img.shields.io/packagist/l/ryangjchandler/computed-properties"></a>
</p>

This package provides a trait and attribute that can provide computed property support.

## Installation

This package can be installed via Composer:

```bash
composer require ryangjchandler/computed-properties
```

## Usage

Begin by adding the `RyanChandler\Computed\Traits\WithComputedProperties` trait to your class:

```php
use RyanChandler\Computed\Traits\WithComputedProperties;

class Person
{
    use WithComputedProperties;

    public function getNameProperty()
    {
        return 'Ryan';
    }
}
```

You can then define a method using the `get[name]Property` naming conventions, where `[name]` is a pascal-cased version of your desired property name.

In the example above, we will be able to access the property `name` on the object.

```php
$person = new Person;

echo $person->name; // 'Ryan'
```

### Using Attributes

This package also provides a `Computed` attribute that allows you to use your own method names.

```php
use RyanChandler\Computed\Traits\WithComputedProperties;
use RyanChandler\Computed\Attributes\Computed;

class Person
{
    use WithComputedProperties;

    public $firstName = 'Ryan';

    public $lastName = 'Chandler';

    #[Computed]
    public function fullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
```

By default, `Computed` will let you access a property using the method name. In the example above, the property will be `fullName`.

```php
$person = new Person;

echo $person->fullName; // 'Ryan Chandler'
```

If you would like to change the name of the computed property, you can pass a string to the attribute.

```php
use RyanChandler\Computed\Traits\WithComputedProperties;
use RyanChandler\Computed\Attributes\Computed;

class Person
{
    use WithComputedProperties;

    public $firstName = 'Ryan';

    public $lastName = 'Chandler';

    #[Computed("name")]
    public function fullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
```

You can now access the `name` property, which will run the `Person::fullName()` method.

```php
$person = new Person;

echo $person->name; // 'Ryan Chandler'
```
