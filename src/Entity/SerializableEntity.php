<?php

namespace App\Entity;

use Symfony\Component\PropertyAccess\PropertyAccess;

abstract class SerializableEntity implements \JsonSerializable
{
    /**
     * Get the only the serializable fields and return as a array
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $json = [];
        $accessor = PropertyAccess::createPropertyAccessor();

        foreach ($this->getSerializableFields() as $attribute) {
            $json[$attribute] = $accessor->getValue($this, "$attribute");
        }

        return $json;
    }

    /**
     * Get the serializable fields
     *
     * @return array
     */
    abstract protected function getSerializableFields() : array;
}
