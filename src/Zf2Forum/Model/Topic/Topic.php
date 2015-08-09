<?php

namespace Zf2Forum\Model\Topic;

use Zf2Forum\Model\Topic\TopicInterface;
use DateTime;

class Topic implements TopicInterface
{
    /**
     * @var int
     */
    private $_id;

    /**
     * @var string
     */
    private $_title;

    private $_text;

    private $_lastPost;

    /**
     * @var integer
     */
    private $_messageCount;

    /**
     * @var integer
     */
    private $_visitCount;


    /**
     * @var DateTime
     */
    private $_timestampCreated;

    /**
     * @var integer
     */
    private $_userId;

    /**
     * @var integer
     */
    private $_forumCategoryId;


    /**
     * @return the $timestampCreated
     */
    public function getTimestampCreated()
    {
        return $this->_timestampCreated;
    }

    /**
     * @param $timestampCreated
     */
    public function setTimestampCreated($postTime)
    {
        $this->_timestampCreated = $postTime;
        return $this;
    }

    /**
     * @return the $_id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return the $_title
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return the $_text
     */
    public function getText()
    {
        return $this->_text;
    }


    /**
     * @param number $_id
     */
    public function setId($_id)
    {
        $this->_id = $_id;
    }

    /**
     * @param string $_title
     */
    public function setTitle($_title)
    {
        $this->_title = $_title;
    }

    /**
     * @param field_type $_text
     */
    public function setText($_text)
    {
        $this->_text = $_text;
    }


    public function getUserId()
    {
        return $this->_userId;
    }

    public function setUserId($_userId)
    {
        $this->_userId = $_userId;
        return $this;
    }

    public function getForumCategoryId()
    {
        return $this->_forumCategoryId;
    }

    public function setForumCategoryId($_forumCategoryId)
    {
        $this->_forumCategoryId = $_forumCategoryId;
        return $this;
    }

    public function getMessagecount()
    {
        return $this->_messageCount;
    }

    public function setMessagecount($_messageCount)
    {
        $this->_messageCount = $_messageCount;
        return $this;
    }

    public function getVisitcount()
    {
        return $this->_visitCount;
    }

    public function setVisitcount($_visitCount)
    {
        $this->_visitCount = $_visitCount;
        return $this;
    }

    public function getLastpost()
    {
        return $this->_lastPost;
    }

    public function setLastpost($_lastPost)
    {
        $this->_lastPost = $_lastPost;
        return $this;
    }

}
