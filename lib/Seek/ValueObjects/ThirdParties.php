<?php namespace Seek\ValueObjects;

use Seek\Exceptions\InvalidArgumentException;

/**
 * Phone value object
 */
final class ThirdParties implements ValueObjectInterface
{
    /**
     * @var string
     */
    protected $advertiserId;

    /**
     * @var string
     */
    protected $agentId;

    /**
     * @param string $advertiserId
     * @param string $agentId
     * @throws InvalidArgumentException
     */
    public function __construct($advertiserId, $agentId = null)
    {
        $this->setAdvertiserId($advertiserId);
        $this->setAgentId($agentId);
    }

    /**
     * @param string $advertiserId
     * @throws InvalidArgumentException
     */
    private function setAdvertiserId($advertiserId)
    {
        if (!is_string($advertiserId)) {
            throw new InvalidArgumentException('Advertisement id must be a string');
        }

        if (!$advertiserId) {
            throw new InvalidArgumentException('Advertisement id cannot be empty');
        }
    }

    /**
     * @return string
     */
    public function getAdvertiserId()
    {
        return $this->advertiserId;
    }

    /**
     * @param string $agentId
     * @throws InvalidArgumentException
     */
    private function setAgentId($agentId)
    {
        if ($agentId !== null && !is_string($agentId)) {
            throw new InvalidArgumentException('Agent id must be a string');
        }

        $this->agentId = $agentId;
    }

    /**
     * @return string
     */
    public function getAgentId()
    {
        return $this->agentId;
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
