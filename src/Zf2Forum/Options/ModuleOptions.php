<?php
namespace Zf2Forum\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    protected $_showQuickReply = false;
    protected $_userColumn = "email";
    protected $_showTimeAgo = false;
    protected $_editPosts = true;

    /**
     *
     * @return the $_showQuickReply
     */
    public function getShowQuickReply()
    {
        return $this->_showQuickReply;
    }

    /**
     *
     * @return the $_userColumn
     */
    public function getUserColumn()
    {
        return $this->_userColumn;
    }

    /**
     *
     * @return the $_showTimeAgo
     */
    public function getShowTimeAgo()
    {
        return $this->_showTimeAgo;
    }

    /**
     *
     * @return the $_editPosts
     */
    public function getEditPosts()
    {
        return $this->_editPosts;
    }

    /**
     *
     * @param boolean $_showQuickReply
     */
    public function setShowQuickReply($_showQuickReply)
    {
        $this->_showQuickReply = $_showQuickReply;
    }

    /**
     *
     * @param string $_userColumn
     */
    public function setUserColumn($_userColumn)
    {
        $this->_userColumn = $_userColumn;
    }

    /**
     *
     * @param boolean $_showTimeAgo
     */
    public function setShowTimeAgo($_showTimeAgo)
    {
        $this->_showTimeAgo = $_showTimeAgo;
    }

    /**
     *
     * @param boolean $_editPosts
     */
    public function setEditPosts($_editPosts)
    {
        $this->_editPosts = $_editPosts;
    }
}
