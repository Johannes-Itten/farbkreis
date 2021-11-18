<?php

namespace Ismaxim\ColorStudio\ModelConverters\Converters\RGB2;

use InvalidArgumentException;
use Ismaxim\ColorStudio\ColorModels\ColorModel;
use Ismaxim\ColorStudio\ColorModels\HSLModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;

/** @package Ismaxim\ColorStudio\ModelConverters\Converters */
final class RGB2HSLConverter implements ModelConverter
{
    /**
     * Works correctly the same as Figma  
     * 
     * 🛈 https://w.wiki/4Pz8  
     * 🛈 https://w.wiki/4Pz9
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

        $max = max($red, $green, $blue);
        $min = min($red, $green, $blue);

        $chroma = $max - $min;
        $lightness = ($max + $min) / 2;

        /* if ($chroma === 0) {
            $hue = 0;
        } elseif ($max === $red) {
            $hue = 60 * (($green + $blue) / $chroma + 0);
        } elseif ($max === $green) {
            $hue = 60 * (($blue - $red) / $chroma + 2);
        } elseif ($max === $blue) {
            $hue = 60 * (($red - $blue) / $chroma  + 4);
        } */

        if ($min === $max) {
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

        if ($lightness === 0 || $lightness === 1) {
            $saturation = 0;
        } else {
            $saturation = $chroma / (1 - abs(2 * $lightness - 1));
        }

        return new HSLModel(...array_values([
            'h' => (int) round($hue),
            's' => (int) round($saturation * 100),
            'v' => (int) round($lightness * 100)
        ]));
    }
}