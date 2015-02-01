<?php
namespace Zf2Forum\Model\Category;

use DateTime;

class Category implements CategoryInterface
{
    private $_id;
    private $_name;
    private $_description;
    private $_timestampCreated;
    /**
     * @var integer
     */
    private $_threadCount;

    /**
     * @var integer
     */
    private $_messageCount;
    /**
     * @var Date
     */
    private $_lastPost;

    public function getId()
    {
        return $this->_id;
    }

    public function setId($_id)
    {
        $this->_id = $_id;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setName($_name)
    {
        $this->_name = $_name;
        return $this;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setDescription($_description)
    {
        $this->_description = $_description;
        return $this;
    }

    public function getTimestampcreated()
    {
        return $this->_timestampCreated;
    }

    public function setTimestampcreated($_timestampCreated)
    {
        $this->_timestampCreated = $_timestampCreated;
        return $this;
    }

    /**
     * Set thread count.
     * @param integer $threadCount
     */
    public function setThreadCount($threadCount)
    {
        $this->threadCount = $threadCount;
        return $this;
    }

    /**
     * Get thread count.
     *
     * @return integer
     */
    public function getThreadCount()
    {
        return $this->threadCount;
    }

    /**
     * Set Message Count.
     *
     * @param integer $messageCount
     */
    public function setMessageCount($messageCount)
    {
        $this->messageCount = $messageCount;
        return $this;
    }

    /**
     * Get Message Count.
     *
     * @return integer
     */
    public function getMessageCount()
    {
        return $this->messageCount;
    }

    /**
     * Set Last Post
     *
     * @param Date $lastPost
     */
    public function setLastPost($lastPost)
    {
        if ($lastPost !== "" and $lastPost !== "NULL" and $lastPost !== NULL) {
            if ($lastPost instanceof DateTime) {
                $this->lastPost = $lastPost;
            } else {
                $this->lastPost = new DateTime($lastPost);
            }
        }
        return $this;
    }

    /**
     * Get Last Post.
     *
     * @return Date
     */
    public function getLastPost()
    {
        return $this->lastPost;
    }
}
