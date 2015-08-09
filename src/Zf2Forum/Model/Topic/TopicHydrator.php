<?php

namespace Zf2Forum\Model\Topic;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zf2Forum\Model\Thread\ThreadInterface;

class TopicHydrator extends ClassMethods
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    public function extract($object)
    {
        if (!$object instanceof TopicInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Zf2Forum\Model\Topic\TopicInterface');
        }
        $data = parent::extract($object);
        if ($data['id'] == "") {
            unset($data['id']);
        }
        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return TopicInterface
     * @throws Exception\InvalidArgumentException
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof TopicInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Zf2Forum\Model\Thread\TopicInterface');
        }
        return parent::hydrate($data, $object);
    }
}
