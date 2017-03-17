<?php namespace Seek;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Seek\Api\EndPointInterface;
use Seek\HttpClient\Plugins\Authentication;
use Seek\HttpClient\Plugins\ExceptionHandler;
use Http\Client\Common\Plugin\AddHostPlugin;

/**
 * PHP trademe.co.nz jobs API client.
 *
 * @method Api\Authorisation authorisation()
 * @method Api\Advertisement advertisement()
 *
 * Website: https://github.com/alagafonov/php-seek-job-ad-posting-api
 */
class Client
{
    /**
     * @var string
     */
    protected $apiUrl = 'https://adposting-integration.cloud.seek.com.au';

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var Plugin[]
     */
    private $plugins = [];

    /**
     * @var PluginClient
     */
    private $pluginClient;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @var bool
     */
    private $createNewHttpClient = true;

    /**
     * @param HttpClient|null $httpClient
     */
    public function __construct(HttpClient $httpClient = null)
    {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->messageFactory = MessageFactoryDiscovery::find();
        $this->addPlugin(new Plugin\AddHostPlugin(UriFactoryDiscovery::find()->createUri($this->apiUrl)));
        $this->addPlugin(new ExceptionHandler());
    }

    /**
     * @param $name
     * @return Api\Authorisation|Api\Advertisement
     * @throws UnknownMethodException
     */
    public function api($name)
    {
        switch ($name) {
            case 'authorisation':
                $api = new Api\Authorisation($this);
                break;
            case 'advertisement':
                $api = new Api\Advertisement($this);
                break;
            default:
                throw new UnknownMethodException('Undefined end point instance called: "' . $name . '"');
        }
        return $api;
    }

    /**
     * @param $name
     * @param $args
     * @return Api\Advertisement
     * @throws UnknownMethodException
     */
    public function __call($name, $args)
    {
        return $this->api($name);
    }

    /**
     * @param $consumerKey
     * @param $consumerSecret
     */
    public function authenticate($consumerKey, $consumerSecret)
    {
        $this->removePlugin(Authentication::class);
        $this->addPlugin(new Authentication($consumerKey, $consumerSecret));
    }

    /**
     * @param Plugin $plugin
     */
    public function addPlugin(Plugin $plugin)
    {
        $this->plugins[get_class($plugin)] = $plugin;
        $this->createNewHttpClient = true;
    }

    /**
     * @param $name
     */
    public function removePlugin($name)
    {
        unset($this->plugins[$name]);
        $this->createNewHttpClient = true;
    }

    /**
     * @return HttpMethodsClient
     */
    public function getHttpClient()
    {
        if ($this->createNewHttpClient) {
            $this->createNewHttpClient = false;
            $this->pluginClient = new HttpMethodsClient(
                new PluginClient($this->httpClient, $this->plugins),
                $this->messageFactory
            );
        }
        return $this->pluginClient;
    }

    /**
     * @param HttpClient $httpClient
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->createNewHttpClient = true;
        $this->httpClient = $httpClient;
    }
}
