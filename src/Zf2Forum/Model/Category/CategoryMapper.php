<?php
namespace Zf2Forum\Model\Category;

use Zend\Db\Sql\Expression;
use Zf2Forum\Model\Category\CategoryInterface;
use Zf2Forum\Module as Zf2Forum;
use Zf2Forum\Service\DbAdapterAwareInterface;
use ZfcBase\Mapper\AbstractDbMapper;

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
        $select = $this->getSelect()->where(array(
            'id' => $id
        ));

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
        $select->join(array(
            't' => 'forum_topic'
        ), 't.forum_category_id = forum_category.id', array(
            'thread_count' => new Expression('COUNT(DISTINCT t.id)')
        ), 'left')
            ->join(array(
                'r' => 'forum_reply'
            ), 'r.forum_topic_id = t.id', array(
                'last_post' => new Expression(
                    'greatest(MAX(t.timestamp_updated), if(MAX(t.timestamp_updated), MAX(t.timestamp_updated), 0))'
                ),
                'message_count' => new Expression('COUNT(r.id)')
            ), 'left')
            ->group(array(
                'forum_category.id'
            ));
        return $this->select($select);
    }
}
