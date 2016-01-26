<?php

namespace Zf2Forum\Model\Topic;

use ZfcBase\Mapper\AbstractDbMapper;
use Zf2Forum\Module as Zf2Forum;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zf2Forum\Service\DbAdapterAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TopicMapper extends AbstractDbMapper implements TopicMapperInterface, DbAdapterAwareInterface, ServiceLocatorAwareInterface
{
    protected $tableName = 'forum_topic';
    protected $service_manager;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->service_manager = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->service_manager;
    }

    /**
     * getTopicById
     *
     * @param int $int
     * @return TopicInterface
     */
    public function getTopicById($id)
    {
        $select = $this->getSelect()
                       ->where(array('id' => $id));
        $ret = $this->select($select)->current();
        /**
         * @return \Zd2Forum\Options\ModuleOptions
         */
        $options = $this->getServiceLocator()->get('Zf2Forum\ModuleOptions');
        $funcName = "get" . $options->getUserColumn();
        $user = $this->getServiceLocator()->get("Zf2Forum_user_mapper")->findById($ret->getUserId());
        $ret->user = $user->$funcName();
        return $ret;
    }

    /**
     * getLatestTopics
     *
     * @param int $limit
     * @param int $offset
     * @return array of TopicInterface's
     */
    public function getLatestTopics($limit = 25, $offset = 0, $tagId = false)
    {
        $select = $this->getSelect();
        $select->join(array('m' => 'forum_reply'),
                       'forum_topic.id = m.forum_topic_id',
                       array(
                           'message_count' => new Expression('COUNT(DISTINCT m.id)'),
                           'last_post' => new Expression('if(MAX(m.timestamp_updated), MAX(m.timestamp_updated), forum_topic.timestamp_updated)')
                       ),
                       'left')
                ->join(array('v' => 'forum_visit'),
                       'v.forum_topic_id = forum_topic.id',
                       array(
                           'visit_count' => new Expression('COUNT(v.id)')
                       ),
                       'left')
                ->where(array('forum_category_id = ?' => $tagId))
                ->group(array('forum_topic.id'));
        //die($select->getSqlString());
        return $this->select($select);
    }

    /**
     * persist - Persists a thread to the database.
     *
     * @param TopicInterface $thread
     * @return TopicInterface
     */
    public function persist(TopicInterface $thread)
    {
        if ($thread->getId() > 0) {
            $this->update($thread, null, null, new TopicHydrator);
        } else {
            $this->insert($thread, null, new TopicHydrator);
        }

        return $thread;
    }

    /**
     * insert - Inserts a new thread into the database, using the specified hydrator.
     *
     * @param ThreadInterface $entity
     * @param String $tableName
     * @param HydratorInterface $hydrator
     * @return unknown
     */
    protected function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setId($result->getGeneratedValue());
        return $result;
    }

    /**
     * update - Updates an existing thread in the database.
     * @param ThreadInterface $entity
     * @param String $where
     * @param String $tableName
     * @param HydratorInterface $hydrator
     */
    protected function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'id = ' . $entity->getId();
        }
        return parent::update($entity, $where, $tableName, $hydrator);
    }
}

