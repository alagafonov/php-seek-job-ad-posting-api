<?php namespace Seek\ValueObjects;

use Seek\Exceptions\InvalidArgumentException;

/**
 * Video value object
 */
final class StandOut implements ValueObjectInterface
{
    /**
     * @var integer
     */
    protected $logoId;

    /**
     * @var string[]
     */
    protected $bullets;

    /**
     * @param integer $logoId
     * @param string[] $bullets
     * @throws InvalidArgumentException
     */
    public function __construct($logoId, array $bullets = [])
    {
        $this->setLogoId($logoId);
        if (!empty($bullets)) {
            foreach ($bullets as $bullet) {
                $this->addBullet($bullet);
            }
        }
    }

    /**
     * @param int $logoId
     * @throws InvalidArgumentException
     */
    private function setLogoId($logoId)
    {
        if (!is_int($logoId)) {
            throw new InvalidArgumentException('Standout logo id must be an integer value');
        }
        $this->logoId = $logoId;
    }

    /**
     * @return integer
     */
    public function getLogoId()
    {
        return $this->logoId;
    }

    /**
     * @param string $bullet
     * @throws InvalidArgumentException
     */
    public function addBullet($bullet)
    {
        if (!is_string($bullet)) {
            throw new InvalidArgumentException('Stand out bullet point must be a string');
        }
        $this->bullets[] = $bullet;
    }

    /**
     * @return string[]
     */
    public function getBullets()
    {
        return $this->bullets;
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
