<?php

namespace Zf2Forum\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zf2Forum\Model\Category\CategoryInterface;
use Zf2Forum\Model\Category\CategoryMapperInterface;
use Zf2Forum\Model\Message\MessageInterface;
use Zf2Forum\Model\Message\MessageMapperInterface;
use Zf2Forum\Model\Topic\TopicInterface;
use Zf2Forum\Model\Topic\TopicMapperInterface;
use Zf2Forum\Model\Visit\VisitInterface;
use Zf2Forum\Model\Visit\VisitMapperInterface;
use ZfcBase\EventManager\EventProvider;

class Discuss extends EventProvider implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var TopicMapperInterface
     */
    protected $topicMapper;

    /**
     * @var MessageMapperInterface
     */
    protected $messageMapper;

    /**
     * @var CategoryMapperInterface
     */
    protected $categoryMapper;

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return Discuss
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * getLatestThreads
     *
     * @param int $limit
     * @param int $offset
     * @param int $tagId
     * @return array
     */
    public function getLatestThreads($limit = 25, $offset = 0, $tagId = false)
    {
        return $this->topicMapper->getLatestTopics($limit, $offset, $tagId);
    }

    /**
     * getMessagesByThread
     *
     * @param ThreadInterface $thread
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getMessagesByThread(TopicInterface $thread, $limit = 25, $offset = 0)
    {
        $messages = $this->messageMapper->getMessagesByTopic($thread->getThreadId(), $limit, $offset);
        $messagesRet = array();
        foreach ($messages as $message) {
            $sender = $this->getServiceManager()->get("Zf2Forum_user_mapper")->findById($message->getUserId());
            /**
             * @return \Zd2Forum\Options\ModuleOptions
             */
            $options = $this->getServiceManager()->get('Zf2Forum\ModuleOptions');
            $funcName = "get" . $options->getUserColumn();
            $message->user = $sender->$funcName();
            $messagesRet[] = $message;
        }

        return $messagesRet;
    }

    /**
     * createThread
     *
     * @param CategoryInterface $tag
     * @param ThreadInterface $thread
     * @return ThreadInterface
     */
    public function createThread(CategoryInterface $tag, TopicInterface $thread)
    {
        $thread->setForumCategoryId($tag->getid());
        $thread->setTimestampCreated(date("Y-m-d H:i:s"));
        $thread->setUserId($this->getServiceManager()->get('zfcuser_auth_service')->getIdentity()->getId());

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $thread,
            array(
                'thread'  => $thread,
            )
        );

        $thread = $this->topicMapper->persist($thread);

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $thread,
            array(
                'thread'  => $thread,
            )
        );

        return $thread;
    }

    /**
     * updateThread
     *
     * @param ThreadInterface $thread
     * @return ThreadInterface
     */
    public function updateThread(TopicMapperInterface $thread)
    {
        return $this->threadMapper->persist($thread);
    }

    /**
     * createMessage
     *
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function createMessage(MessageInterface $message)
    {
        // Set post time and persist message.
        $message->setUserId($this->getServiceManager()->get('zfcuser_auth_service')->getIdentity()->getId());
        $message->setTimestampCreated(new \DateTime);

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $message,
            array(
                'message' => $message,
            )
        );

        $message = $this->messageMapper->persist($message);

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $message,
            array(
                'message' => $message,
            )
        );
        return $message;
    }

    /**
     * updateMessage
     *
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function updateMessage(MessageInterface $message)
    {
        $message->setPostTime(new \DateTime);
        return $this->messageMapper->persist($message);
    }

    /**
     * getTagById
     *
     * @param int $id
     * @return CategoryInterface
     */
    public function getCategoryById($id)
    {
        return $this->categoryMapper->getCategoryById($id);
    }

    /**
     * getCategories
     *
     * @return array
     */
    public function getCategories()
    {
        return $this->categoryMapper->getCategories();
    }

    /**
     * getThreadById
     *
     * @param int $threadId
     * @return ThreadInterface
     */
    public function getTopicById($threadId)
    {
        return $this->topicMapper->getTopicById($threadId);
    }

    /**
     * getMessageById
     *
     * @param int $messageId
     * @return MessageInterface
     */
    public function getMessageById($messageId)
    {
        return $this->messageMapper->getMessageById($messageId);
    }

    /**
     * getThreadMapper
     *
     * @return ThreadMapperInterface
     */
    public function getThreadMapper()
    {
        return $this->threadMapper;
    }

    /**
     * setThreadMapper
     *
     * @param ThreadMapperInterface $threadMapper
     * @return Discuss
     */
    public function setTopicMapper($topicMapper)
    {
        $this->topicMapper = $topicMapper;
        return $this;
    }

    /**
     * getMessageMapper
     *
     * @return MessageMapperInterface
     */
    public function getMessageMapper()
    {
        return $this->messageMapper;
    }

    /**
     * setMessageMapper
     *
     * @param MessageMapperInterface $messageMapper
     * @return Discuss
     */
    public function setMessageMapper($messageMapper)
    {
        $this->messageMapper = $messageMapper;
        return $this;
    }

    /**
     * Get categoryMapper.
     *
     * @return categoryMapper
     */
    public function getCategoryMapper()
    {
        return $this->categoryMapper;
    }

    /**
     * Set categoryMapper.
     *
     * @param CategoryMapperInterface $categoryMapper the value to be set
     */
    public function setCategoryMapper(CategoryMapperInterface $categoryMapper)
    {
        $this->categoryMapper = $categoryMapper;
        return $this;
    }

    /**
     * Set Visit Mapper
     *
     * Enter description here ...
     * @param VisitMapperInterface $visitMapper
     */
    public function setVisitMapper(VisitMapperInterface $visitMapper)
    {
        $this->visitMapper = $visitMapper;
        return $this;
    }

    /**
     * Get Vist Mapper.
     *
     * Enter description here ...
     */
    public function getVisitMapper()
    {
        return $this->visitMapper;
    }

    /**
     * storeVisitIfUnique - records the visit if it is unuiqe.
     * @param VisitInterface $vist
     * @return \Zf2Forum\Service\Discuss
     */
    public function storeVisitIfUnique(VisitInterface $visit)
    {
        $this->getVisitMapper()->storeVisitIfUnique($visit);
        return $this;
    }
}
