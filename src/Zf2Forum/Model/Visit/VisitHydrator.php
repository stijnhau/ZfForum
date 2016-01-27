<?php
namespace Zf2Forum\Model\Visit;

use Zend\Stdlib\Hydrator\ClassMethods;

class VisitHydrator extends ClassMethods
{
    /**
     * extract
     *
     * @param unknown_type $object
     * @throws Exception\InvalidArgumentException
     * @return unknown
     */
    public function extract($object)
    {
        if (!$object instanceof VisitInterface) {
            throw new Exception\InvalidArgumentException(
                '$object must be an instance of Zf2Forum\Model\Visit\VisitInterface'
            );
        }
        $data = parent::extract($object);

        $thread = $object->getThread();
        $data['thread_id'] = (int)$thread->getThreadId();
        unset($data['thread']);
        $data['visit_time'] = $data['visit_time']->format('Y-m-d H:i:s');
        return $data;
    }

    /**
     * hydrate
     *
     * @param unknown_type $object
     * @throws Exception\InvalidArgumentException
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof VisitInterface) {
            throw new Exception\InvalidArgumentException(
                '$object must be an instance of Zf2Forum\Model\Visit\VisitInterface'
            );
        }

        return parent::hydrate($data, $object);
    }
}
