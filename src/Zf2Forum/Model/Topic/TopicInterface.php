<?php

namespace Zf2Forum\Model\Topic;

use Zf2Forum\Model\Message\MessageInterface;

interface TopicInterface
{
    /**
     * @return the $_id
     */
    public function getId();

    /**
     * @return the $_title
     */
    public function getTitle();

    /**
     * @return the $_text
     */
    public function getText();

    /**
     * @return the $_latestMessage
     */
    public function getLatestMessage();

    /**
     * @return the $_messageCount
     */
    public function getMessageCount();

    /**
     * @return the $_visitCount
     */
    public function getVisitCount();

    /**
     * @return the $_lastPost
     */
    public function getLastPost();

    /**
     * @param number $_id
     */
    public function setId($_id);

    /**
     * @param string $_title
     */
    public function setTitle($_title);

    /**
     * @param field_type $_text
     */
    public function setText($_text);

    /**
     * @param \Zf2Forum\Model\Topic\TopicInterface $_latestMessage
     */
    public function setLatestMessage(TopicInterface $_latestMessage);

    /**
     * @param number $_messageCount
     */
    public function setMessageCount($_messageCount);

    /**
     * @param number $_visitCount
     */
    public function setVisitCount($_visitCount);

    /**
     * @param \Date $_lastPost
     */
    public function setLastPost($_lastPost);
}
