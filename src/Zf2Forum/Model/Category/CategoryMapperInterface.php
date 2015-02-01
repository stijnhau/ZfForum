<?php

namespace Zf2Forum\Model\Category;

interface CategoryMapperInterface
{
    /**
     * getTagById
     *
     * @param int $id
     * @return CategoryInterface
     */
    public function getCategoryById($id);

    /**
     * getTags
     *
     * @return array of CategoryInterface's
     */
    public function getCategories();
}
