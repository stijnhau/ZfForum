<?php

namespace Zf2Forum\Model\Category;

use ZfcBase\Mapper\AbstractDbMapper;
use Zf2Forum\Module as Zf2Forum;
use Zf2Forum\Service\DbAdapterAwareInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;
use Zf2Forum\Model\Category\CategoryInterface;

class CategoryMapper extends AbstractDbMapper implements CategoryMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'forum_category';

    /**
     * getCategoryById
     *
     * @param int $id
     * @return CategoryInterface
     */
    public function getCategoryById($id)
    {
        $select = $this->getSelect()
                       ->where(array('id' => $id));

        return $this->select($select)->current();
    }

    /**
     * getTags
     *
     * @return array of CategoryInterface's
     */
    public function getCategories()
    {
    	$select = $this->getSelect();
    	$select->join(array('t' => 'forum_topic'),
                      't.forum_category_id = forum_category.id',
                      array('thread_count' => new Expression('COUNT(DISTINCT t.id)')),
                      'left')
               ->join(array('r' => 'forum_reply'),
                      'r.forum_topic_id = t.id',
                      array('last_post' => new Expression('if(MAX(r.timestamp_updated), MAX(r.timestamp_updated), 0)'),
                            'message_count' => new Expression('COUNT(r.id)')),
                      'left')
               ->group(array('forum_category.id'));
        return $this->select($select);
    }
}
