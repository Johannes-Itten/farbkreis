<?php

namespace Ismaxim\ColorStudio\ColorModels;

use OutOfRangeException;

/** @package Ismaxim\ColorStudio\ColorModels */
final class RGBModel extends ColorModel
{
    private int $red;
    private int $green;
    private int $blue;

    public function __construct(int $red, int $green, int $blue)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;

        if ($this->red < 0 || $this->red > 255) {
            throw new OutOfRangeException('
                The red is out of the accepted value range of [0-255] numbers.
            ');
        } elseif ($this->green < 0 || $this->green > 255) {
            throw new OutOfRangeException('
                The green is out of the accepted value range of [0-255] numbers.
            ');
        } elseif ($this->blue < 0 || $this->blue > 255) {
            throw new OutOfRangeException('
                The blue is out of the accepted value range of [0-255] numbers.
            ');
        }

        // ...
    }

    public function getValues(): array
    {
        return [$this->red, $this->green, $this->blue];
    }

    /* public function toHEX(ConvertersFactory $factory): HEXModel
    {
        return $factory
            ->getConverter(self::class, HEXModel::class)
            ->convert($this);
    }

    public function toHSV(ConvertersFactory $factory): HSVModel
    {
        return $factory
            ->getConverter(self::class, HSVModel::class)
            ->convert($this);
    }

    public function toHSL(ConvertersFactory $factory): HSLModel
    {
        return $factory
            ->getConverter(self::class, HSLModel::class)
            ->convert($this);
    } */
}