<?php namespace Seek\Api;

use Seek\Entities\Advertisement as AdvertisementEntity;

/**
 * Listing end point
 */
class Advertisement extends ApiAbstract
{
    /**
     * @param AdvertisementEntity $advertisement
     * @return mixed
     * @throws \Seek\Exceptions\InvalidArgumentException
     */
    public function postPosition(AdvertisementEntity $advertisement)
    {
        return $this->query(
            '
                mutation ($input: PostPositionInput!) {
                  postPosition(input: $input) {
                    ... on PostPositionPayload_Success {
                      positionOpening {
                        documentId {
                          value
                        }
                      }
                      positionProfile {
                        profileId {
                          value
                        }
                      }
                    }
                    ... on PostPositionPayload_Conflict {
                      conflictingPositionOpening {
                        documentId {
                          value
                        }
                      }
                      conflictingPositionProfile {
                        profileId {
                          value
                        }
                      }
                    }
                  }
                }
            ',
            [
                'input' => $advertisement->getArray(),
            ]
        )['data'];
    }

    /**
     * @param AdvertisementEntity $advertisement
     * @return mixed
     * @throws \Seek\Exceptions\InvalidArgumentException
     */
    public function updatePostedPositionProfile(AdvertisementEntity $advertisement)
    {
        return $this->query(
            '
                mutation ($input: UpdatePostedPositionProfileInput!) {
                  updatePostedPositionProfile(input: $input) {
                    positionProfile {
                      profileId {
                        value
                      }
                    }
                  }
                }
            ',
            [
                'input' => $advertisement->getArray(false),
            ]
        )['data'];
    }

    /**
     * @param string $profileId
     * @return string
     */
    public function closePostedPositionProfile($profileId)
    {
        $data = $this->query(
            '
                mutation ($input: ClosePostedPositionProfileInput!) {
                  closePostedPositionProfile(input: $input) {
                    positionProfile {
                      profileId {
                        value
                      }
                    }
                  }
                }
            ',
            [
                'input' => [
                    'positionProfile' => [
                        'profileId' => $profileId,
                    ],
                ],
            ]
        )['data'];
        return !empty($data['closePostedPositionProfile']['positionProfile']['profileId']['value']) ?
            $data['closePostedPositionProfile']['positionProfile']['profileId']['value'] : null;
    }

    /**
     * @param string $profileId
     * @return array
     */
    public function getPositionProfile($profileId)
    {
        return $this->query(
            '
                query ($id: String!) {
                  positionProfile(id: $id) {
                    profileId {
                      value
                    }
                    positionTitle
                    positionUri
                    postingInstructions {
                      start
                      end
                    }
                  }
                }
            ',
            [
                'id' => $profileId
            ]
        )['data'];
    }
}
