<?php

namespace Ismaxim\ColorStudio\ModelConverters\Factories;

use InvalidArgumentException;
use Ismaxim\ColorStudio\ColorModels\RGBModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;
use Ismaxim\ColorStudio\ColorModels\Proxies\ConvertersFactory;
use Ismaxim\ColorStudio\ModelConverters\Converters\HEX2\HEX2RGBConverter;
use Ismaxim\ColorStudio\ModelConverters\Converters\RGB2\RGB2HSLConverter;
use Ismaxim\ColorStudio\ModelConverters\Converters\RGB2\RGB2HSVConverter;

/** @package Ismaxim\ColorStudio\ModelConverters\Factories */
final class HEXConvertersFactory implements ConvertersFactory
{
    /**
     * @param string $conversion_vector 
     * @return ModelConverter 
     * @throws InvalidArgumentException 
     */
    public function getConverter(string $conversion_vector): ModelConverter
    {
        switch ($conversion_vector) {
            case RGBModel::class: $converter = new HEX2RGBConverter;
            /* case HSVModel::class: $converter = new HEX2HSVConverter(
                new HEX2RGBConverter, 
                new RGB2HSVConverter
            ); */
            /* case HSLModel::class: $converter = new HEX2HSLConverter(
                new HEX2RGBConverter, 
                new RGB2HSLConverter
            ); */
            default: throw new InvalidArgumentException("
                Unknown color model format {$conversion_vector}.
            ");
        }

        return $converter;
    }
}