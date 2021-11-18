<?php

namespace Ismaxim\ColorStudio\ModelConverters\Factories;

use InvalidArgumentException;
use Ismaxim\ColorStudio\ColorModels\HSVModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;
use Ismaxim\ColorStudio\ColorModels\Proxies\ConvertersFactory;
use Ismaxim\ColorStudio\ModelConverters\Converters\HSL2\HSL2HSVConverter;
use Ismaxim\ColorStudio\ModelConverters\Converters\RGB2\RGB2HEXConverter;

/** @package Ismaxim\ColorStudio\ModelConverters\Factories */
final class HSLConvertersFactory implements ConvertersFactory
{
    /**
     * @param string $conversion_vector 
     * @return ModelConverter 
     * @throws InvalidArgumentException 
     */
    public function getConverter(string $conversion_vector): ModelConverter
    {
        switch ($conversion_vector) {
            // case RGBModel::class: $converter = new HSL2RGBConverter;
            case HSVModel::class: $converter = new HSL2HSVConverter;
            /* case HEXModel::class: $converter = new HSL2HEXConverter(
                new HSL2RGBConverter, 
                new RGB2HEXConverter
            ); */
            default: throw new InvalidArgumentException("
                Unknown color model format {$conversion_vector}.
            ");
        }

        return $converter;
    }
}