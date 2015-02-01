<?php

namespace Zf2Forum\Model\Topic;

use ZfcBase\Model\ModelAbstract;
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

    /**
     * @var MessageInterface
     */
    private $_latestMessage;

    /**
     * @var integer
     */
    private $_messageCount;

    /**
     * @var integer
     */
    private $_visitCount;

    /**
     * @var Date
     */
    private $_lastPost;

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
     * @return the $_latestMessage
     */
    public function getLatestMessage()
    {
        return $this->_latestMessage;
    }

    /**
     * @return the $_messageCount
     */
    public function getMessageCount()
    {
        return $this->_messageCount;
    }

    /**
     * @return the $_visitCount
     */
    public function getVisitCount()
    {
        return $this->_visitCount;
    }

    /**
     * @return the $_lastPost
     */
    public function getLastPost()
    {
        return $this->_lastPost;
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

    /**
     * @param \Zf2Forum\Model\Topic\TopicInterface $_latestMessage
     */
    public function setLatestMessage(TopicInterface $_latestMessage)
    {
        $this->_latestMessage = $_latestMessage;
    }

    /**
     * @param number $_messageCount
     */
    public function setMessageCount($_messageCount)
    {
        $this->_messageCount = $_messageCount;
    }

    /**
     * @param number $_visitCount
     */
    public function setVisitCount($_visitCount)
    {
        $this->_visitCount = $_visitCount;
    }

    /**
     * @param \Zf2Forum\Model\Topic\Date $_lastPost
     */
    public function setLastPost($_lastPost)
    {
        $this->_lastPost = $_lastPost;
    }
}
