<?php
namespace Zf2Forum\Model\Visit;

interface VisitMapperInterface
{
    public function storeVisitIfUnique($visit);
}
