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
     * @return the $_messageCount
     */
    public function getMessageCount();

    /**
     * @return the $_visitCount
     */
    public function getVisitCount();

    /**
     * @return the $_forumCategoryId
     */
    public function getForumCategoryId();

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
     * @param number $_messageCount
     */
    public function setMessageCount($_messageCount);

    /**
     * @param number $_visitCount
     */
    public function setVisitCount($_visitCount);

    /**
     * @param string $_forumCategoryId
     */
    public function setForumCategoryId($_forumCategoryId);
}
