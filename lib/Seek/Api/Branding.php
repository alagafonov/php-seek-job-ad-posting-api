<?php namespace Seek\Api;

/**
 * GraphQL category
 */
class Branding extends ApiAbstract
{
    /**
     * @param string $hirerId
     * @param int $first
     * @param int $after
     * @return array[]
     */
    public function getAll($hirerId, $first = 10, $after = null)
    {
        $data = $this->query(
            '
                query ($after: String, $first: Int, $hirerId: String!) {
                  advertisementBrandings(after: $after, first: $first, hirerId: $hirerId) {
                    edges {
                      node {
                        id {
                          value
                        }
                        name
                        images {
                          typeCode
                          url
                        }
                      }
                    }
                    pageInfo {
                      hasNextPage
                      endCursor
                    }
                  }
                }
            ',
            [
                'hirerId' => $hirerId,
                'first'   => $first,
                'after'   => $after,
            ]
        )['data'];

        $result = ['brands' => []];
        if (!empty($data['advertisementBrandings']['edges'])) {
            $result['pageInfo'] = $data['advertisementBrandings']['pageInfo'];
            foreach ($data['advertisementBrandings']['edges'] as $edge) {
                $images = [];
                if (!empty($edge['node']['images'])) {
                    foreach ($edge['node']['images'] as $image) {
                        $images[$image['typeCode']] = $image['url'];
                    }
                }
                $result['brands'][] = [
                    'id'     => $edge['node']['id']['value'],
                    'name'   => $edge['node']['name'],
                    'images' => $images,
                ];
            }
        }
        return $result;
    }
}
