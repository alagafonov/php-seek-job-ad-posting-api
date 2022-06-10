<?php namespace Seek\Entities;

/**
 * Category relationship entity
 */
class CategoryRelationship extends Entity
{
    /**
     * Category
     *
     * @var Category
     */
    protected $category;

    /**
     * Child categories
     *
     * @var Category[]
     */
    protected $children;

    /**
     * @param Category $category
     * @param Category[] $children
     */
    public function __construct(Category $category, array $children = [])
    {
        $this->setCategory($category);
        $this->setChildren($children);
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category[] $children
     */
    public function setChildren(array $children)
    {
        $this->children = $children;
    }

    /**
     * @return Category[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        $result = [
            'category' => $this->getCategory()->getArray(),
            'children' => [],
        ];
        $children = $this->getChildren();
        if (!empty($children)) {
            foreach ($children as $child) {
                $result['children'][] = $child->getArray();
            }
        }
        return $result;
    }
}
