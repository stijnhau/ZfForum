<?php

namespace Zf2Forum\Model\Message;

interface MessageMapperInterface
{
    /**
     * getMessageById
     *
     * @param int $messageId
     * @return MessageInterface
     */
    public function getMessageById($messageId);

    /**
     * getMessagesByThread
     *
     * @param int $threadId
     * @param int $limit
     * @param int $offest
     * @return array of Zf2Forum\Model\Message\MessageInterface's
     */
    public function getMessagesByTopic($threadId, $limit = 25, $offset = 0);

    /**
     * persist
     *
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function persist(MessageInterface $message);
}
