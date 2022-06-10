<?php namespace Seek\Api;

use Seek\Entities\JobCategorySuggestionPositionProfileInput;
use Seek\Factories\CategoryFactory;

/**
 * GraphQL category
 */
class Category extends ApiAbstract
{
    /**
     * @param string $schemeId
     * @param JobCategorySuggestionPositionProfileInput $positionProfile
     * @param int $first
     * @return \Seek\Entities\CategorySuggestion[]
     * @throws \Seek\Exceptions\InvalidArgumentException
     */
    public function suggest($schemeId, JobCategorySuggestionPositionProfileInput $positionProfile, $first = 10)
    {
        $result = $this->query(
            '
                query (
                  $positionProfile: JobCategorySuggestionPositionProfileInput!
                  $schemeId: String!
                  $first: Int
                ) {
                  jobCategorySuggestions(
                    positionProfile: $positionProfile
                    schemeId: $schemeId
                    first: $first
                  ) {
                    jobCategory {
                      id {
                        value
                      }
                      name
                      parent {
                        id {
                          value
                        }
                        name
                      }
                    }
                    confidence
                  }
                }
            ',
            [
                'schemeId'        => $schemeId,
                'positionProfile' => $positionProfile->getArray(),
                'first'           => $first,
            ]
        )['data'];

        if (!empty($result['jobCategorySuggestions'])) {
            return CategoryFactory::createSuggestionResultFromQueryResponse($result['jobCategorySuggestions']);
        }
    }

    /**
     * @param string $schemeId
     * @return array|\Seek\Entities\CategoryRelationship
     * @throws \Seek\Exceptions\InvalidArgumentException
     */
    public function getAll($schemeId)
    {
        $result = $this->query(
            '
                query ($schemeId: String!) {
                  jobCategories(schemeId: $schemeId) {
                    id {
                      value
                    }
                    name
                    children {
                      id {
                        value
                      }
                      name
                    }
                  }
                }
            ',
            [
                'schemeId' => $schemeId,
            ]
        )['data'];

        if (!empty($result['jobCategories'])) {
            return CategoryFactory::createCategoryRelationshipListFromArray($result['jobCategories']);
        }
    }
}
