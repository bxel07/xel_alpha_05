<?php 
namespace setup\baseclass;
use setup\config\xgen;
class BaseData
{
    /**
     * @var mixed|xgen
     */

    protected mixed $query;

    /**
     * Constructor have a function to load instance of object class
     */
    public function __construct()
    {
        $this->query = new xgen();
    }
}
