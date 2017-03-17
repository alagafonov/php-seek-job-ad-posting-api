<?php namespace Seek\ValueObjects;

use Seek\Exceptions\InvalidArgumentException;
use Seek\Enums\Position;

/**
 * Video value object
 */
final class Video implements ValueObjectInterface
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var Position
     */
    protected $position;

    /**
     * @param string $url
     * @param Position|null $position
     * @throws InvalidArgumentException
     */
    public function __construct($url, Position $position = null)
    {
        $this->setUrl($url);
        $this->setPosition($position);
    }

    /**
     * @param string $url
     * @throws InvalidArgumentException
     */
    private function setUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Video URL format is invalid');
        }
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param Position|null $position
     * @throws InvalidArgumentException
     */
    private function setPosition(Position $position = null)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return [
            'advertiserId' => $this->getAdvertiserId(),
            'agentId'      => $this->getAgentId(),
        ];
    }
}
