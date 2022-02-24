<?php namespace Seek\Api;

/**
 * Authorisation end point
 */
class Authorisation extends ApiAbstract
{
    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $audience
     * @param string $grantType
     * @return array
     */
    public function retrieveAccessToken($clientId, $clientSecret, $audience, $grantType)
    {
        return $this->post(
            'https://auth.seek.com/oauth/token',
            [
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'audience'      => $audience,
                'grant_type'    => $grantType,
            ]
        );
    }
}
