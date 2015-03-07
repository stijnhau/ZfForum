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
    public function getId();

    /**
     * Set messageId.
     *
     * @param int $messageId the value to be set
     */
    public function setId($messageId);

    /**
     * Get postTime.
     *
     * @return DateTime
     */
    public function getTimestampCreated();

    /**
     * Set postTime.
     *
     * @param mixed $postTime the value to be set
     */
    public function setTimestampCreated($postTime);

    /**
     * Get subject.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set subject.
     *
     * @param string $subject the value to be set
    */
    public function setTitle($subject);

    /**
     * Get message.
     *
     * @return string
     */
    public function getText();

    /**
     * Set message.
     *
     * @param string $message the value to be set
     */
    public function setText($message);

    /**
     * @return the $user_id
     */
    public function getUserId();

    /**
     * @param number $user_id
     */
    public function setUserId($userId);
}
