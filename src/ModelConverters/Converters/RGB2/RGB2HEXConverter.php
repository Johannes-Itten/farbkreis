<?php

namespace Ismaxim\ColorStudio\ModelConverters\Converters\RGB2;

use Ismaxim\ColorStudio\ColorModels\ColorModel;
use Ismaxim\ColorStudio\ColorModels\HEXModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;

/** @package Ismaxim\ColorStudio\ModelConverters\Converters */
final class RGB2HEXConverter implements ModelConverter
{
    /**
     * @param ColorModel $model 
     * @return ColorModel 
     */
    public function convert(ColorModel $model): ColorModel
    {
        [$red, $green, $blue] = $model->getValues();

        /* if ($red < 0 || $red > 255) {
            throw new InvalidArgumentException("Red is out of the accepted value range of [0-255]");
        }
        if ($green < 0 || $green > 255) {
            throw new InvalidArgumentException("Green is out of the accepted value range of [0-255]");
        }
        if ($blue < 0 || $blue > 255) {
            throw new InvalidArgumentException("Blue is out of the accepted value range of [0-255]");
        } */

        $hex_value = sprintf("#%02x%02x%02x", $red, $green, $blue);
        [$hex_red, $hex_green, $hex_blue] = str_split($hex_value, 2);

        return new HEXModel($hex_red, $hex_green, $hex_blue);
    }
}