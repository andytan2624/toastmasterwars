<?php

namespace App\ToastmasterWars\Transformers;

abstract class Transformer {
    /**
     * Transform a collection of entitites
     */
    public function transformCollection($items)
    {
        return array_map([$this, 'transform'], $items->toArray());
    }

    public abstract function transform($item);
}