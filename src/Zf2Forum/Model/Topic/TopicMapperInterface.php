<?php

namespace Zf2Forum\Model\Topic;

interface TopicMapperInterface
{
    /**
     * getTopicById
     *
     * @param int $threadId
     * @return ThreadInterface
     */
    public function getTopicById($threadId);

    /**
     * getLatestTopics
     *
     * @param int $limit
     * @param int $offset
     * @return array of TopicInterface's
     */
    public function getLatestTopics($limit = 25, $offset = 0);

    /**
     * persist
     *
     * @param TopicInterface $topic
     * @return TopicInterface
     */
    public function persist(TopicInterface $topic);
}
