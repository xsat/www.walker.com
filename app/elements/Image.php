<?php

namespace Elements;

class Image extends \Phalcon\Forms\Element\File
{
    public function render($attributes = [])
    {
        $entity = $this->getForm()->getEntity();
        $image = '';
        $methodName = 'get' . ucfirst($this->getName());

        if (method_exists($entity, $methodName) && $entity->id && $entity->{$this->getName()}) {
            $image = '<img id="loaded-image" style="max-height: 200px;" src="' . $entity->{$methodName}() . '">';
        }

        return $image . parent::render($attributes);
    }
}