<?php

namespace Ismaxim\ColorStudio\ModelConverters\Converters\HSV2;

use InvalidArgumentException;
use Ismaxim\ColorStudio\ColorModels\ColorModel;
use Ismaxim\ColorStudio\ColorModels\RGBModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;

/** @package Ismaxim\ColorStudio\ModelConverters\Converters */
final class HSV2RGBConverter implements ModelConverter
{
    /**
     * Works correctly same as Figma
     * 
     * 🛈 https://w.wiki/4Put
     * 
     * @param ColorModel $model 
     * @return ColorModel 
     * @throws InvalidArgumentException 
     */
    public function convert(ColorModel $model): ColorModel
    {
        [$hue, $saturation, $value] = $model->getValues();

        /* if ($hue < 0 || $hue > 360) {
            throw new InvalidArgumentException("Hue is out of the accepted value range of [0-360]");
        }
        if ($saturation < 0 || $saturation > 100) {
            throw new InvalidArgumentException("Saturation is out of the accepted value range of [0-100]");
        }
        if ($value < 0 || $value > 100) {
            throw new InvalidArgumentException("Value is out of the accepted value range of [0-100]");
        } */

        $hue_index = abs($hue / 60) % 6;
        $value_min = ((100 - $saturation) * $value) / 100;
        $a = ($value - $value_min) * (($hue % 60) / 60);
        $value_inc = $value_min + $a;
        $value_dec = $value - $a;

        if ($hue_index === 0) {
            [$r, $g, $b] = [$value, $value_inc, $value_dec];
        } elseif ($hue_index === 1) {
            [$r, $g, $b] = [$value_dec, $value, $value_min];
        } elseif ($hue_index === 2) {
            [$r, $g, $b] = [$value_min, $value, $value_inc];
        } elseif ($hue_index === 3) {
            [$r, $g, $b] = [$value_min, $value_dec, $value];
        } elseif ($hue_index === 4) {
            [$r, $g, $b] = [$value_inc, $value_min, $value];
        } elseif ($hue_index === 5) {
            [$r, $g, $b] = [$value, $value_min, $value_dec];
        }

        return new RGBModel(...array_values([
            'r' => (int) round($r * (255 / 100)), 
            'g' => (int) round($g * (255 / 100)), 
            'b' => (int) round($b * (255 / 100))
        ]));
    }
}