<?php namespace Seek\Entities;

/**
 * Category suggestion result entity
 */
class CategorySuggestion extends Entity
{
    /**
     * Suggested category
     *
     * @var Category
     */
    protected $category;

    /**
     * Parent category
     *
     * @var Category
     */
    protected $parent;

    /**
     * @param Category $category
     * @param Category $parent
     */
    public function __construct(Category $category, Category $parent = null)
    {
        $this->setCategory($category);
        $this->setParent($parent);
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
     * @param Category $parent
     */
    public function setParent(Category $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        $result = [
            'category' => $this->getCategory()->getArray(),
        ];
        $parent = $this->getParent();
        if ($parent !== null) {
            $result['parent'] = $parent->getArray();
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getSuggestionLabel()
    {
        $result = '';
        $parent = $this->getParent();
        if ($parent !== null) {
            $result = $parent->getName() . ' > ';
        }
        $result .= $this->getCategory()->getName();
        return $result;
    }
}
