<?php

namespace Ismaxim\ColorStudio\ModelConverters\Factories;

use InvalidArgumentException;
use Ismaxim\ColorStudio\ColorModels\RGBModel;
use Ismaxim\ColorStudio\ColorModels\HSLModel;
use Ismaxim\ColorStudio\ColorModels\HEXModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;
use Ismaxim\ColorStudio\ColorModels\Proxies\ConvertersFactory;
use Ismaxim\ColorStudio\ModelConverters\Converters\HSV2\HSV2HEXConverter;
use Ismaxim\ColorStudio\ModelConverters\Converters\HSV2\HSV2HSLConverter;
use Ismaxim\ColorStudio\ModelConverters\Converters\HSV2\HSV2RGBConverter;
use Ismaxim\ColorStudio\ModelConverters\Converters\RGB2\RGB2HEXConverter;

/** @package Ismaxim\ColorStudio\ModelConverters\Factories */
final class HSVConvertersFactory implements ConvertersFactory
{
    /**
     * @param string $conversion_vector 
     * @return ModelConverter 
     * @throws InvalidArgumentException 
     */
    public function getConverter(string $conversion_vector): ModelConverter
    {
        switch ($conversion_vector) {
            case RGBModel::class: $converter = new HSV2RGBConverter;
            case HSLModel::class: $converter = new HSV2HSLConverter;
            case HEXModel::class: $converter = new HSV2HEXConverter(
                new HSV2RGBConverter, 
                new RGB2HEXConverter
            );
            default: throw new \InvalidArgumentException("
                Unknown color model format {$conversion_vector}.
            ");
        }

        return $converter;
    }
}