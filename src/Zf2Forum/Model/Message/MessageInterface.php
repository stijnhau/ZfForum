<?php

namespace Zf2Forum\Model\Message;

use DateTime;

interface MessageInterface
{
    /**
     * Get messageId.
     *
     * @return int
     */
    public function getMessageId();

    /**
     * Set messageId.
     *
     * @param int $messageId the value to be set
     */
    public function setMessageId($messageId);

    /**
     * Get postTime.
     *
     * @return DateTime
     */
    public function getPostTime();

    /**
     * Set postTime.
     *
     * @param mixed $postTime the value to be set
     */
    public function setPostTime($postTime);

    /**
     * Get subject.
     *
     * @return string
     */
    public function getSubject();
    
    /**
     * Set subject.
     *
     * @param string $subject the value to be set
    */
    public function setSubject($subject);
    
    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage();

    /**
     * Set message.
     *
     * @param string $message the value to be set
     */
    public function setMessage($message);

    /**
     * Get parentMessageId.
     *
     * @return int
     */
    public function getParentMessageId();

    /**
     * Set parentMessageId.
     *
     * @param int $parentMessageId the value to be set
     */
    public function setParentMessageId($parentMessageId);
    
    /**
     * @return the $user_id
     */
    public function getUserId();
    
    /**
     * @param number $user_id
     */
    public function setUserId($userId);
}
