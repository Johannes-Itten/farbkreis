<?php

namespace Ismaxim\ColorStudio\ColorModels;

use OutOfRangeException;

/** @package Ismaxim\ColorStudio\ColorModels */
final class HEXModel extends ColorModel
{
    private string $hex_red;
    private string $hex_green;
    private string $hex_blue;
    
    public function __construct(string $hex_red, string $hex_green, string $hex_blue)
    {
        $this->hex_red = preg_replace("/[^0-9A-Fa-f]/", '', $hex_red);
        $this->hex_green = preg_replace("/[^0-9A-Fa-f]/", '', $hex_green);
        $this->hex_blue = preg_replace("/[^0-9A-Fa-f]/", '', $hex_blue);

        if (strlen($this->hex_red) < 1 || strlen($this->hex_red) > 2) {
            throw new OutOfRangeException('
                The hex red value is out of the accepted value range of the [1-2] symbols.
            ');
        } elseif (strlen($this->hex_green) < 1 || strlen($this->hex_green) > 2) {
            throw new OutOfRangeException('
                The hex green value is out of the accepted value range of the [1-2] symbols.
            ');
        } elseif (strlen($this->hex_blue) < 1 || strlen($this->hex_blue) > 2) {
            throw new OutOfRangeException('
                The hex blue value is out of the accepted value range of the [1-2] symbols.
            ');
        }

        // ...
    }

    public function getValues(): array
    {
        return [$this->hex_red, $this->hex_green, $this->hex_blue];
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

    public function toHSL(ConvertersFactory $factory): HSLModel
    {
        return $factory
            ->getConverter(self::class, HSLModel::class)
            ->convert($this);
    } */
}