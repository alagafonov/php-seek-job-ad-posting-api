<?php namespace Seek\ValueObjects;

use Seek\Exceptions\InvalidArgumentException;

/**
 * Phone value object
 */
final class Location implements ValueObjectInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $areaId;

    /**
     * @param string $id
     * @param string $areaId
     * @throws InvalidArgumentException
     */
    public function __construct($id, $areaId = null)
    {
        $this->setId($id);
        $this->setAreaId($areaId);
    }

    /**
     * @param string $id
     * @throws InvalidArgumentException
     */
    private function setId($id)
    {
        if (!is_string($id)) {
            throw new InvalidArgumentException('Location id must be a string');
        }

        if (!$id) {
            throw new InvalidArgumentException('Location id cannot be empty');
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->advertiserId;
    }

    /**
     * @param string $areaId
     * @throws InvalidArgumentException
     */
    private function setAreaId($areaId)
    {
        if ($areaId !== null && !is_string($areaId)) {
            throw new InvalidArgumentException('Location area id must be a string');
        }

        $this->areaId = $areaId;
    }

    /**
     * @return string
     */
    public function getAreaId()
    {
        return $this->areaId;
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
