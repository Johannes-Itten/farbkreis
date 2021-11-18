<?php

namespace Ismaxim\ColorStudio\ColorModels;

use OutOfRangeException;

/** @package Ismaxim\ColorStudio\ColorModels */
final class HSLModel extends ColorModel
{
    private int $hue;
    private int $saturation;
    private int $lightness;
    
    public function __construct(int $hue, int $saturation, int $lightness)
    {
        $this->hue = $hue;
        $this->saturation = $saturation;
        $this->lightness = $lightness;

        if ($this->hue < 0 || $this->hue > 360) {
            throw new OutOfRangeException('
                The hue value is out of the accepted value range of [0-360] numbers.
            ');
        } elseif ($this->saturation < 0 || $this->saturation > 100) {
            throw new OutOfRangeException('
                The saturation value is out of the accepted value range of [0-100] numbers.
            ');
        } elseif ($this->lightness < 0 || $this->lightness > 100) {
            throw new OutOfRangeException('
                The lightness value is out of the accepted value range of [0-100] numbers.
            ');
        }

        // ...
    }

    public function getValues(): array
    {
        return [$this->hue, $this->saturation, $this->lightness];
    }

    /* public function toRGB(ConvertersFactory $factory): RGBModel
    {
        return $factory
            ->getConverter(self::class, RGBModel::class)
            ->convert($this);
    }

    public function toHSV(ConvertersFactory $factory): HSVModel
    {
        return $factory
            ->getConverter(self::class, HSVModel::class)
            ->convert($this);
    }

    public function toHEX(ConvertersFactory $factory): HEXModel
    {
        return $factory
            ->getConverter(self::class, HEXModel::class)
            ->convert($this);
    } */
}