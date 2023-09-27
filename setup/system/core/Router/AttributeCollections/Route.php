<?php

namespace setup\system\core\Router\AttributeCollections;

use Attribute;
#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Route
{
    public function __construct
    (
        public string $uri,
        public string $RequestMethod,
        public array $Middleware = [],
        public int|bool $VRoute = 1,
    )
    {

    }
}