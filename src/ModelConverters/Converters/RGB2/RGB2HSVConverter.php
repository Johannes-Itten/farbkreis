<?php

namespace Ismaxim\ColorStudio\ModelConverters\Converters\RGB2;

use InvalidArgumentException;
use Ismaxim\ColorStudio\ColorModels\ColorModel;
use Ismaxim\ColorStudio\ColorModels\HSVModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;

/** @package Ismaxim\ColorStudio\ModelConverters\Converters\RGB2 */
final class RGB2HSVConverter implements ModelConverter
{
    /**
     * Works correctly the same as Figma  
     * 
     * 🛈 https://w.wiki/4Pum
     * 
     * @param ColorModel $model 
     * @return ColorModel 
     * @throws InvalidArgumentException 
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

        [$red, $green, $blue] = [$red / 255, $green / 255, $blue / 255];

        $max = max($red, $green, $blue);
        $min = min($red, $green, $blue);

        if ($max === $min) {
            $hue = 0;
        } elseif ($max === $red && $green >= $blue) {
            $hue = 60 * ($green - $blue) / ($max - $min) + 0;
        } elseif ($max === $red && $green < $blue) {
            $hue = 60 * ($green - $blue) / ($max - $min) + 360;
        } elseif ($max === $green) {
            $hue = 60 * ($blue - $red) / ($max - $min) + 120;
        } elseif ($max === $blue) {
            $hue = 60 * ($red - $green) / ($max - $min) + 240;
        }

        $saturation = ($max == 0) ? 0 : 1 - ($min / $max);
        $value = $max;

        return new HSVModel(...array_values([
            'h' => (int) round($hue),
            's' => (int) round($saturation * 100),
            'v' => (int) round($value * 100)
        ]));
    }
}