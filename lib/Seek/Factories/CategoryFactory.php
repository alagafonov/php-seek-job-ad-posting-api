<?php namespace Seek\Factories;

use Seek\Entities\Category;
use Seek\Entities\CategoryRelationship;
use Seek\Entities\CategorySuggestion;

/**
 * Category factory
 */
class CategoryFactory extends AbstractEntityFactory
{
    /**
     * @param array $data
     * @return CategorySuggestion[]
     * @throws \Seek\Exceptions\InvalidArgumentException
     */
    public static function createSuggestionResultFromQueryResponse(array $data)
    {
        $result = [];
        foreach ($data as $record) {
            if (!empty($record['jobCategory'])) {
                $result[] = self::createCategorySuggestionFromArray($record['jobCategory']);
            }
        }
        return $result;
    }

    /**
     * @param array $data
     * @return CategorySuggestion
     * @throws \Seek\Exceptions\InvalidArgumentException
     */
    public static function createCategorySuggestionFromArray(array $data)
    {
        $parent = null;
        if (isset($data['parent']['id']['value'])) {
            $parent = new Category($data['parent']['id']['value'], $data['parent']['name']);
        }
        return new CategorySuggestion(new Category($data['id']['value'], $data['name']), $parent);
    }

    /**
     * @param array $data
     * @return CategoryRelationship
     * @throws \Seek\Exceptions\InvalidArgumentException
     */
    public static function createCategoryRelationshipFromArray(array $data)
    {
        $children = [];
        if (!empty($data['children'])) {
            foreach ($data['children'] as $child) {
                $children[] = new Category($child['id']['value'], $child['name']);
            }
        }
        return new CategoryRelationship(new Category($data['id']['value'], $data['name']), $children);
    }

    /**
     * @param array $data
     * @return CategoryRelationship
     * @throws \Seek\Exceptions\InvalidArgumentException
     */
    public static function createCategoryRelationshipListFromArray(array $data)
    {
        $list = [];
        foreach ($data as $category) {
            $list[] = self::createCategoryRelationshipFromArray($category);
        }
        return $list;
    }
}
