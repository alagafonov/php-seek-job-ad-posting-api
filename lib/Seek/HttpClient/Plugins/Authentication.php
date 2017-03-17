<?php namespace Seek\HttpClient\Plugins;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;

/**
 * Authentication plugin.
 */
class Authentication implements Plugin
{
    /**
     * @var string
     */
    private $consumerKey;

    /**
     * @var string
     */
    private $consumerSecret;

    private $accessToken;

    private $accessTokenExpiry = 0;

    /**
     * @param $consumerKey
     * @param $consumerSecret
     */
    public function __construct($consumerKey, $consumerSecret)
    {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
    }

    /**
     * @param RequestInterface $request
     * @param callable $next
     * @param callable $first
     * @return mixed
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        $request = $request->withHeader(
            'Authorization',
            sprintf(
                'OAuth oauth_consumer_key="%s", oauth_token="%s", oauth_signature_method="PLAINTEXT", ' .
                'oauth_signature="%s&%s"',
                $this->consumerKey,
                $this->accessToken,
                $this->consumerSecret,
                $this->tokenSecret
            )
        );

        return $next($request);
    }
}
