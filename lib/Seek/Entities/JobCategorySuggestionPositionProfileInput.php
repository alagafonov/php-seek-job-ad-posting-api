<?php namespace Seek\Entities;

use Seek\Exceptions\InvalidArgumentException;

/**
 * Advertisement entity
 */
class JobCategorySuggestionPositionProfileInput extends Entity
{
    /**
     * Position location
     *
     * @var string
     */
    protected $positionLocation;

    /**
     * Position title
     *
     * @var string
     */
    protected $positionTitle;

    /**
     * Position format description
     *
     * @var PositionFormattedDescriptionInput
     */
    protected $positionFormattedDescriptions;

    /**
     * Country code
     *
     * @var string[]
     */
    protected $positionOrganizations;

    /**
     * @param string $positionLocation
     * @param string $positionTitle
     * @param PositionFormattedDescriptionInput $positionFormattedDescriptions
     * @param array $positionOrganizations
     * @throws InvalidArgumentException
     */
    public function __construct(
        $positionLocation,
        $positionTitle,
        PositionFormattedDescriptionInput $positionFormattedDescriptions = null,
        array $positionOrganizations = []
    ) {
        $this->setPositionLocation($positionLocation);
        $this->setPositionTitle($positionTitle);
        $this->setPositionFormattedDescriptions($positionFormattedDescriptions);
        $this->setPositionOrganizations($positionOrganizations);
    }

    /**
     * @param string $positionLocation
     * @throws InvalidArgumentException
     */
    public function setPositionLocation($positionLocation)
    {
        if (empty($positionLocation)) {
            throw new InvalidArgumentException('Position location cannot be empty');
        }
        if (!is_string($positionLocation)) {
            throw new InvalidArgumentException('Position location must be a string');
        }
        $this->positionLocation = $positionLocation;
    }

    /**
     * @return string
     */
    public function getPositionLocation()
    {
        return $this->positionLocation;
    }

    /**
     * @param string $positionTitle
     * @throws InvalidArgumentException
     */
    public function setPositionTitle($positionTitle)
    {
        if (empty($positionTitle)) {
            throw new InvalidArgumentException('Position title cannot be empty');
        }
        if (!is_string($positionTitle)) {
            throw new InvalidArgumentException('Position title must be a string');
        }
        $this->positionTitle = $positionTitle;
    }

    /**
     * @return string
     */
    public function getPositionTitle()
    {
        return $this->positionTitle;
    }

    /**
     * @param PositionFormattedDescriptionInput $positionFormattedDescriptions
     */
    public function setPositionFormattedDescriptions(
        PositionFormattedDescriptionInput $positionFormattedDescriptions = null
    ) {
        $this->positionFormattedDescriptions = $positionFormattedDescriptions;
    }

    /**
     * @return string
     */
    public function getPositionFormattedDescriptions()
    {
        return $this->positionFormattedDescriptions;
    }

    /**
     * @param array $positionOrganizations
     */
    public function setPositionOrganizations(array $positionOrganizations)
    {
        $this->positionOrganizations = $positionOrganizations;
    }

    /**
     * @return array
     */
    public function getPositionOrganizations()
    {
        return $this->positionOrganizations;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        $result = [
            'positionLocation' => $this->getPositionLocation(),
            'positionTitle'    => $this->getPositionTitle(),
        ];
        $positionDescription = $this->getPositionFormattedDescriptions();
        if ($positionDescription !== null) {
            $result['positionFormattedDescriptions'] = $positionDescription->getArray();
        }
        $positionOrganisations = $this->getPositionOrganizations();
        if (!empty($positionOrganisations)) {
            $result['positionOrganizations'] = $positionOrganisations;
        }
        return $result;
    }
}
