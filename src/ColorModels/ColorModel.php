<?php

namespace Ismaxim\ColorStudio\ColorModels;

/** @package Ismaxim\ColorStudio\ColorModels */
abstract class ColorModel 
{
    protected string $conversion_vector;
    protected ModelConverter $converter;

    /** @return array  */
    abstract public function getValues(): array;
    
    /** 
     * Return information about the last conversion vector  
     * of this model (ex. RGB → HSV - returns HSV)
     * 
     * @return string 
    */
    public function getLastConversionVector(): string
    {
        return $this->conversion_vector;
    }
}