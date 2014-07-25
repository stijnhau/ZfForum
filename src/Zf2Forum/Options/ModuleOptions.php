<?php

namespace Zf2Forum\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    protected $showQuickReply = false;
    
	/**
     * @return the $showQuickReply
     */
    public function getShowQuickReply()
    {
        return $this->showQuickReply;
    }

	/**
     * @param boolean $showQuickReply
     */
    public function setShowQuickReply($showQuickReply)
    {
        $this->showQuickReply = $showQuickReply;
    }
}
