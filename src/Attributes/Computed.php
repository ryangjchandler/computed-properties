<?php

namespace RyanChandler\Computed\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Computed
{
    public function __construct(
        public ?string $name = null
    ) {

    }
}
