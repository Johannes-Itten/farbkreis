<?php

namespace Ismaxim\ColorStudio\ModelConverters\Converters\HSV2;

use Ismaxim\ColorStudio\ColorModels\ColorModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;
use Ismaxim\ColorStudio\ModelConverters\Converters\RGB2\RGB2HEXConverter;

/** @package Ismaxim\ColorStudio\ModelConverters\Converters */
final class HSV2HEXConverter implements ModelConverter
{
    /**
     * @var HSV2RGBConverter
     */
    private HSV2RGBConverter $hsv2rgb_convertor;

    /**
     * @var RGB2HEXConverter
     */
    private RGB2HEXConverter $rgb2hex_convertor;

    /**
     * @param HSV2RGBConverter $hsv2rgb_convertor 
     * @param RGB2HEXConverter $rgb2hex_convertor 
     * @return void 
     */
    public function __construct(
        HSV2RGBConverter $hsv2rgb_convertor,
        RGB2HEXConverter $rgb2hex_convertor
    ) {
        $this->hsv2rgb_convertor = $hsv2rgb_convertor;
        $this->rgb2hex_convertor = $rgb2hex_convertor;
    }

    /**
     * @param ColorModel $model 
     * @return ColorModel 
     */
    public function convert(ColorModel $model): ColorModel
    {
        $rgb_model = $this->hsv2rgb_convertor->convert($model);
        $hex_model = $this->rgb2hex_convertor->convert($rgb_model);

        return $hex_model;
    }
}