<?php

namespace Zf2Forum\Model\Message;

use DateTime;

class Message implements MessageInterface
{
    /**
     * @var int
     */
    protected $messageId;

    /**
     * @var DateTime
     */
    protected $postTime;

    /**
     * @var ThreadInterface
     */
    protected $thread;
    
    /**
     * @var string
     */
    protected $subject;
    
    /**
     * @var string
     */
    protected $message;

    /**
     * @var int
     */
    protected $parentMessageId;
    
    /**
     * @var int
     */
    protected $user_id;

    /**
     * @return the $user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

	/**
     * @param number $user_id
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

	/**
     * Get messageId.
     *
     * @return int
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set messageId.
     *
     * @param int $messageId the value to be set
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
        return $this;
    }

    /**
     * Get postTime.
     *
     * @return DateTime
     */
    public function getPostTime()
    {
        return $this->postTime;
    }

    /**
     * Set postTime.
     *
     * @param mixed $postTime the value to be set
     */
    public function setPostTime($postTime)
    {
        if ($postTime instanceof DateTime) {
            $this->postTime = $postTime;
        } else {
            $this->postTime = new DateTime($postTime);
        }
        return $this;
    }

    /**
     * Get thread.
     *
     * @return ThreadInterface
     */
    public function getThread()
    {
        return $this->thread;
    }
    
    /**
     * Set thread.
     *
     * @param ThreadInterface $thread the value to be set
     */
    public function setThread($thread)
    {
        $this->thread = $thread;
        return $this;
    }
    
    /**
     * Get subject.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
    /**
     * Set subject.
     *
     * @param string $subject the value to be set
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }
    
    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message.
     *
     * @param string $message the value to be set
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get parentMessageId.
     *
     * @return int
     */
    public function getParentMessageId()
    {
        return $this->parentMessageId;
    }

    /**
     * Set parentMessageId.
     *
     * @param int $parentMessageId the value to be set
     */
    public function setParentMessageId($parentMessageId)
    {
        $this->parentMessageId = $parentMessageId;
        return $this;
    }
}
