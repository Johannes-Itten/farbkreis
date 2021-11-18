<?php

namespace Ismaxim\ColorStudio\ModelConverters\Converters\HEX2;

use Ismaxim\ColorStudio\ColorModels\ColorModel;
use Ismaxim\ColorStudio\ColorModels\RGBModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;
use RangeException;

/** @package Ismaxim\ColorStudio\ModelConverters\Converters */
final class HEX2RGBConverter implements ModelConverter
{
    /**
     * @param ColorModel $model 
     * @return ColorModel 
     */
    public function convert(ColorModel $model): ColorModel
    {
        [$hex_red, $hex_green, $hex_blue] = $model->getValues();

        // add exceptional checks on the values of the model

        $hex_value = implode('', [$hex_red, $hex_green, $hex_blue]);
        
        // if (strlen($hex_blue) > 6) {
            // throw new RangeException(
                // 'Hex is out of the accepted value range of [0-6] symbols
            // ');
        // }

        [$red, $green, $blue] = (strlen($hex_blue) === 3) 
            ? sscanf($hex_value, "%1x%1x%1x")
            : sscanf($hex_value, "%02x%02x%02x");

        return new RGBModel($red, $green, $blue);
    }
}