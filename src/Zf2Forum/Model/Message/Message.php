<?php

namespace Zf2Forum\Model\Message;

use DateTime;

class Message implements MessageInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var DateTime
     */
    protected $timestampCreated;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $text;


    /**
     * @var int
     */
    protected $userId;

  /**
     * @return the $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

  /**
     * @param number $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

  /**
     * Get messageId.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set messageId.
     *
     * @param int $messageId the value to be set
     */
    public function setId($messageId)
    {
        $this->id = $messageId;
        return $this;
    }

    /**
     * Get postTime.
     *
     * @return DateTime
     */
    public function getTimestampCreated()
    {
        return $this->timestampCreated;
    }

    /**
     * Set postTime.
     *
     * @param mixed $postTime the value to be set
     */
    public function setTimestampCreated($postTime)
    {
        if ($postTime instanceof DateTime) {
            $this->timestampCreated = $postTime;
        } else {
            $this->timestampCreated = new DateTime($postTime);
        }
        return $this;
    }

    /**
     * Get subject.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subject.
     *
     * @param string $subject the value to be set
     */
    public function setTitle($subject)
    {
        $this->title = $subject;
        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set message.
     *
     * @param string $message the value to be set
     */
    public function setText($message)
    {
        $this->text = $message;
        return $this;
    }
}
