<?php

use function PHPUnit\Framework\assertEquals;
use RyanChandler\Computed\Attributes\Computed;
use RyanChandler\Computed\Traits\WithComputedProperties;

class Example
{
    use WithComputedProperties;

    public function getNameProperty()
    {
        return 'Ryan';
    }
}

class ExampleWithAttributes
{
    use WithComputedProperties;

    #[Computed]
    public function name()
    {
        return 'Ryan';
    }

    #[Computed('email')]
    public function getEmail()
    {
        return 'test@test.com';
    }
}

it('can compute properties', function () {
    expect(new Example())->name->toBe('Ryan');
});

it('can compute properties defined via attribute', function () {
    $object = new ExampleWithAttributes();

    assertEquals('Ryan', $object->name);
});

it('can compute properties defined via attribute with custom name', function () {
    $object = new ExampleWithAttributes();

    assertEquals('test@test.com', $object->email);
});
