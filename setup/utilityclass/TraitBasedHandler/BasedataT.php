<?php

    namespace setup\utilityclass\TraitBasedHandler;

    trait BasedataT{
        public function getFillable():array {
            if(property_exists($this, 'fillable')) {
                return $this->fillable;
            }

            return [];
        }
    }