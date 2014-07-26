<?php

namespace Zf2Forum\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    protected $_showQuickReply = false;
    protected $_userColumn = "email";
    
    
	/**
     * @return the $_showQuickReply
     */
    public function getShowQuickReply()
    {
        return $this->_showQuickReply;
    }

	/**
     * @return the $_userColumn
     */
    public function getUserColumn()
    {
        return $this->_userColumn;
    }

	/**
     * @param boolean $_showQuickReply
     */
    public function setShowQuickReply($_showQuickReply)
    {
        $this->_showQuickReply = $_showQuickReply;
    }

	/**
     * @param string $_userColumn
     */
    public function setUserColumn($_userColumn)
    {
        $this->_userColumn = $_userColumn;
    }   
}
