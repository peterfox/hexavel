<?php

namespace ResourceFactory;

use BehatResources\ResourceFactory;

/**
 * @author      Peter Fox <peter.fox@peterfox.me>
 * @copyright   Peter Fox 2015
 *
 * @package     hexavel
 */
class EloquentResourceFactory implements ResourceFactory
{

    /**
     * @param string $class
     * @param string $type
     * @param array $arguments
     * @return Object
     */
    public function buildObject($class, $type, $arguments = [])
    {
        return factory($class)->make($arguments);
    }

    /**
     * @param string $class
     * @param string $type
     * @param array $arguments
     * @return Object
     */
    public function buildPersistedObject($class, $type, $arguments = [])
    {
        return factory($class)->create($arguments);
    }
}