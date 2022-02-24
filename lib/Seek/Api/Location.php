<?php namespace Seek\Api;

use Seek\Enums\UsageType;
use Seek\Factories\LocationFactory;

/**
 * GraphQL location
 */
class Location extends ApiAbstract
{
    /**
     * @param string $schemeId
     * @param string $text
     * @param string $usageTypeCode
     * @param int $first
     * @param string $hirerId
     * @return mixed
     */
    public function suggest($schemeId, $text, $usageTypeCode = UsageType::POSITION_POSTING, $first = 10, $hirerId = '')
    {
        $result = $this->query(
            '
                query (
                  $first: Int!
                  $hirerId: String!
                  $schemeId: String!
                  $text: String!
                  $usageTypeCode: String!
                ) {
                  locationSuggestions(
                    first: $first
                    hirerId: $hirerId
                    schemeId: $schemeId
                    text: $text
                    usageTypeCode: $usageTypeCode
                  ) {
                    location {
                      id {
                        value
                      }
                      name
                      contextualName
                      countryCode
                    }
                  }
                }
            ',
            [
                'schemeId'      => $schemeId,
                'text'          => $text,
                'usageTypeCode' => $usageTypeCode,
                'first'         => $first,
                'hirerId'       => $hirerId,
            ]
        )['data'];

        if (!empty($result['locationSuggestions'])) {
            return LocationFactory::createFromQueryResponse($result['locationSuggestions']);
        }
    }
}
