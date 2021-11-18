<?php

namespace Ismaxim\ColorStudio\ModelConverters\Converters\HSV2;

use InvalidArgumentException;
use Ismaxim\ColorStudio\ColorModels\ColorModel;
use Ismaxim\ColorStudio\ColorModels\HSLModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;

/** @package Ismaxim\ColorStudio\ModelConverters\Converters\HSV2 */
final class HSV2HSLConverter implements ModelConverter
{
    /**
     * Works correctly same as Figma *!
     * 
     * 🛈 https://w.wiki/4QGg
     * 
     * @param ColorModel $model 
     * @return ColorModel 
     * @throws InvalidArgumentException 
     */
    public function convert(ColorModel $model): ColorModel
    {
        [$hsv_hue, $hsv_saturation, $value] = $model->getValues();

        /* if ($hsv_hue < 0 || $hsv_hue > 360) {
            throw new InvalidArgumentException("Hue is out of the accepted value range of [0-360]");
        }
        if ($hsv_saturation < 0 || $hsv_saturation > 1) {
            throw new InvalidArgumentException("Saturation is out of the accepted value range of [0-1]");
        }
        if ($value < 0 || $value > 1) {
            throw new InvalidArgumentException("Value is out of the accepted value range of [0-1]");
        } */

        $hsl_hue = $hsv_hue;
        $lightness = $value * (1 - ($hsv_saturation / 2));

        if ($lightness === 0 || $lightness === 1) {
            $hsl_saturation = 0;
        } else {
            $hsl_saturation = ($value - $lightness) / min($lightness, 1 - $lightness);
        }

        return new HSLModel(...array_values([
            'h' => (int) round($hsl_hue),
            's' => (int) round($hsl_saturation * 100),
            'l' => (int) round($lightness * 100)
        ]));
    }
}