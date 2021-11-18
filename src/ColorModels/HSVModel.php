<?php

namespace Ismaxim\ColorStudio\ColorModels;

use OutOfRangeException;

/** @package Ismaxim\ColorStudio\ColorModels */
final class HSVModel extends ColorModel
{
    private int $hue;
    private int $saturation;
    private int $value;

    public function __construct(int $hue, int $saturation, int $value)
    {
        $this->hue = $hue;
        $this->saturation = $saturation;
        $this->value = $value;

        if ($this->hue < 0 || $this->hue > 360) {
            throw new OutOfRangeException('
                The hue value is out of the accepted value range of [0-360] numbers.
            ');
        } elseif ($this->saturation < 0 || $this->saturation > 100) {
            throw new OutOfRangeException('
                The saturation value is out of the accepted value range of [0-100] numbers.
            ');
        } elseif ($this->value < 0 || $this->value > 100) {
            throw new OutOfRangeException('
                The value is out of the accepted value range of [0-100] numbers.
            ');
        }

        // ...
    }

    /** @return array  */
    public function getValues(): array
    {
        return [$this->hue, $this->saturation, $this->value];
    }

    /**
     * @param null|ModelConverter $converter 
     * @return RGBModel 
     */
    public function toRGB(?ModelConverter $converter = null): RGBModel
    {
        $this->conversion_vector = RGBModel::class;

        return ($converter) 
            ? $converter->convert($this) 
            : $this->converter->convert($this);
    }

    /**
     * @param null|ModelConverter $converter 
     * @return HSLModel 
     */
    public function toHSL(?ModelConverter $converter = null): HSLModel
    {
        $this->conversion_vector = HSLModel::class;

        return ($converter) 
            ? $converter->convert($this) 
            : $this->converter->convert($this);
    }

    /**
     * @param null|ModelConverter $converter 
     * @return HEXModel 
     */
    public function toHEX(?ModelConverter $converter = null): HEXModel
    {
        $this->conversion_vector = HEXModel::class;

        return ($converter) 
            ? $converter->convert($this) 
            : $this->converter->convert($this);
    }
}