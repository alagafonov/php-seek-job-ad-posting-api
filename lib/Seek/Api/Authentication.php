<?php namespace Seek\Api;

/**
 * Authentication end point
 */
class Authentication extends ApiAbstract
{
    /**
     * @param string $hirerId
     * @param string $scope
     * @param string $userId
     * @return mixed
     */
    public function getWebToken($hirerId, $scope, $userId)
    {
        return $this->post(
            '/auth/token',
            [
                'hirerId' => $hirerId,
                'scope'   => $scope,
                'userId'  => $userId,
            ]
        );
    }
}
