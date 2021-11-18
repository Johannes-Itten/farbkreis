<?php

namespace Ismaxim\ColorStudio\ColorModels\Proxies;

use Ismaxim\ColorStudio\ColorModels\ModelConverter;

/** 
 * Abstract Factory Pattern 
 * 
 * 🛈 https://maxsite.org/page/php-abstractfactory  
 * 🛈 https://refactoring.guru/design-patterns/abstract-factory
 * 
 * @package Ismaxim\ColorStudio\ModelConverters\Proxies
*/
interface ConvertersFactory
{
    /**
     * @param string $conversion_vector 
     * @return ModelConverter 
     */
    public function getConverter(string $conversion_vector): ModelConverter;
}