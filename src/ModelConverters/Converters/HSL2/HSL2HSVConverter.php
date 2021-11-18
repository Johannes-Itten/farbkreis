<?php

namespace Ismaxim\ColorStudio\ModelConverters\Converters\HSL2;

use Ismaxim\ColorStudio\ColorModels\ColorModel;
use Ismaxim\ColorStudio\ColorModels\HSVModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;
use RangeException;

/** @package Ismaxim\ColorStudio\ModelConverters\Converters */
final class HSL2HSVConverter implements ModelConverter
{
    /**
     * 🛈 https://stackoverflow.com/a/54116681/11591375
     * 🛈 https://i.stack.imgur.com/GuBWM.png
     * 
     * @param ColorModel $model 
     * @return ColorModel 
     * @throws RangeException 
     */
    public function convert(ColorModel $model): ColorModel
    {
        [$hsl_hue, $hsl_saturation, $lightness] = $model->getValues();

        /* if ($hsl_hue < 0 || $hsl_hue > 360) {
            throw new RangeException("Hue is out of the accepted value range of [0-360]");
        }
        if ($hsl_saturation < 0 || $hsl_saturation > 1) {
            throw new RangeException("Saturation is out of the accepted value range of [0-1]");
        }
        if ($lightness < 0 || $lightness > 1) {
            throw new RangeException("Value is out of the accepted value range of [0-1]");
        } */

        $hsv_hue = $hsl_hue;
        $value = $lightness + $hsl_saturation * min($lightness, 1 - $lightness);
        
        if ($value === 0) {
            $hsv_saturation = 0;
        } else {
            $hsv_saturation = 2 - 2 * ($lightness / $value);
        }

        return new HSVModel(...array_values([
            'h' => (int) round($hsv_hue),
            's' => (int) round($hsv_saturation * 100),
            'v' => (int) round($value * 100)
        ]));
    }
}