<?php

namespace Ismaxim\ColorStudio\ColorModels;

/** 
 * Proxy-Strategy Pattern(s)
 * 
 * (Proxy in sense of use between multiple converter classes which taken 
 * in the concrete Proxy (in the role of Context) from specific {Model}ProxyFactory)
 * 
 * (Strategy in sense of use between multiple converter classes as strategies 
 * and {Model}ProxyConverter (in the role of Context))
 * 
 * 🛈 https://maxsite.org/page/php-strategy
 * 🛈 https://refactoring.guru/design-patterns/proxy
 * 
 * 🛈 https://maxsite.org/page/php-strategy  
 * 🛈 https://refactoring.guru/design-patterns/strategy
 * 
 * @package Ismaxim\ColorStudio\ColorModels 
*/
interface ModelConverter
{
    /**
     * @param ColorModel $model 
     * @return ColorModel 
     */
    public function convert(ColorModel $model): ColorModel;
}