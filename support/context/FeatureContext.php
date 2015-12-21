<?php

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Hexavel\HexavelContext;
use Hexavel\Traits\CacheTrait;
use Hexavel\Traits\DatabaseTrait;
use ResourceFactory\EloquentResourceFactory;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends HexavelContext
{
    use DatabaseTrait;
    use CacheTrait;

    public function getResourceFactory()
    {
        return new EloquentResourceFactory();
    }

    /**
     * @Then /^there is a (?P<entityType>[^"]*) with (?: |a |an )(?P<field>[^"]*) of "(?P<value>[^"]*)"$/
     * @param string $entityType
     * @param string $field
     * @param string $value
     */
    public function thereIsAEntityWithValue($entityType, $field, $value)
    {
        $entity = app()->make($this->getResourceClass($entityType))->where($field, $value)->first();
        expect($entity)->toNotBe(null);
    }
}