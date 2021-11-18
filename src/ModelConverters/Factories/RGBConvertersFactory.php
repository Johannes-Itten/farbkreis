<?php

namespace Ismaxim\ColorStudio\ModelConverters\Factories;

use InvalidArgumentException;
use Ismaxim\ColorStudio\ColorModels\HEXModel;
use Ismaxim\ColorStudio\ColorModels\HSLModel;
use Ismaxim\ColorStudio\ColorModels\HSVModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;
use Ismaxim\ColorStudio\ColorModels\Proxies\ConvertersFactory;
use Ismaxim\ColorStudio\ModelConverters\Converters\RGB2\RGB2HEXConverter;
use Ismaxim\ColorStudio\ModelConverters\Converters\RGB2\RGB2HSLConverter;
use Ismaxim\ColorStudio\ModelConverters\Converters\RGB2\RGB2HSVConverter;

/** @package Ismaxim\ColorStudio\ModelConverters\Factories */
final class RGBConvertersFactory implements ConvertersFactory
{
    /**
     * @param string $conversion_vector 
     * @return ModelConverter 
     * @throws InvalidArgumentException 
     */
    public function getConverter(string $conversion_vector): ModelConverter
    {
        switch ($conversion_vector) {
            case HSVModel::class: $converter = new RGB2HSVConverter;
            case HSLModel::class: $converter = new RGB2HSLConverter;
            case HEXModel::class: $converter = new RGB2HEXConverter;
            default: throw new InvalidArgumentException("
                Unknown color model format {$conversion_vector}.
            ");
        }

        return $converter;
    }
}