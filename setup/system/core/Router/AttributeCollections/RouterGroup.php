<?php

namespace setup\system\core\Router\AttributeCollections;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS|Attribute::IS_REPEATABLE)]
class RouterGroup
{
    public function __construct
    (
        public string $prefix,
        public int|bool $status = 0|false,
        public array $middleware = [],
    )
    {}
}