<?php

namespace Ismaxim\ColorStudio\ModelConverters\Proxies;

use Ismaxim\ColorStudio\ColorModels\ColorModel;
use Ismaxim\ColorStudio\ColorModels\ModelConverter;
use Ismaxim\ColorStudio\ColorModels\Proxies\ConvertersFactory;

/** @package Ismaxim\ColorStudio\ModelConverters\Proxies */
final class HSVProxyConverter implements ModelConverter
{
    /**
     * @var ConvertersFactory
     */
    private ConvertersFactory $converters_factory;

    /**
     * In-memory cache for instantiated converters
     * 
     * @var array
     */
    private array $converters_cache;

    /**
     * @param ConvertersFactory $factory 
     * @return void 
     */
    public function __construct(ConvertersFactory $factory)
    {
        $this->converters_factory = $factory;
    }

    /**
     * @param ColorModel $model 
     * @return ColorModel 
     * @throws InvalidArgumentException 
     */
    public function convert(ColorModel $model): ColorModel
    {
        $conversion_vector = $model->getLastConversionVector();
        
        // If the cache does not contain a convertor to the needed model 
        // - create a new one and cache it.
        if (! isset($this->converters_factory[$conversion_vector])) {
            $converter = $this->converters_factory
                ->getConverter(HSVModel::class, $conversion_vector);

            $this->converters_cache[$conversion_vector] = $converter;
        } 

        return $this->converters_cache[$conversion_vector]->convert($model);
    }
}