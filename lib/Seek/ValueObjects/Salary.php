<?php namespace Seek\ValueObjects;

use Seek\Exceptions\InvalidArgumentException;
use Seek\Enums\SalaryType;

/**
 * Phone value object
 */
final class Salary implements ValueObjectInterface
{
    /**
     * @var SalaryType
     */
    protected $type;

    /**
     * @var float
     */
    protected $minimum;

    /**
     * @var float
     */
    protected $maximum;

    /**
     * @var string
     */
    protected $details;

    /**
     * @param SalaryType $type
     * @param float $minimum
     * @param float $maximum
     * @param string|null $details
     */
    public function __construct(SalaryType $type, $minimum, $maximum, $details = null)
    {
        $this->setType($id);
        $this->setAreaId($areaId);
    }

    /**
     * @param SalaryType $type
     */
    private function setType(SalaryType $type)
    {
        $this->type = $type;
    }

    /**
     * @return SalaryType
     */
    public function getType()
    {
        return $this->type;
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
