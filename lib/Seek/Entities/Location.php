<?php namespace Seek\Entities;

use Seek\Exceptions\InvalidArgumentException;

/**
 * Advertisement entity
 */
class Location extends Entity
{
    /**
     * Location id
     *
     * @var string
     */
    protected $id;

    /**
     * Location name
     *
     * @var string
     */
    protected $name;

    /**
     * Contextual name
     *
     * @var string
     */
    protected $contextualName;

    /**
     * Country code
     *
     * @var string
     */
    protected $countryCode;

    /**
     * @param string $id
     * @param string $name
     * @param string $contextualName
     * @param string $countryCode
     * @throws InvalidArgumentException
     */
    public function __construct(
        $id,
        $name,
        $contextualName,
        $countryCode
    ) {
        $this->setId($id);
        $this->setName($name);
        $this->setContextualName($contextualName);
        $this->setCountryCode($countryCode);
    }

    /**
     * @param string $id
     * @throws InvalidArgumentException
     */
    public function setId($id)
    {
        if (!is_string($id)) {
            throw new InvalidArgumentException('Id must be a string');
        }
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @throws InvalidArgumentException
     */
    public function setName($name)
    {
        if (!is_string($name)) {
            throw new InvalidArgumentException('Name must be a string');
        }
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $contextualName
     * @throws InvalidArgumentException
     */
    public function setContextualName($contextualName)
    {
        if (!is_string($contextualName)) {
            throw new InvalidArgumentException('Contextual name must be a string');
        }
        $this->contextualName = $contextualName;
    }

    /**
     * @return string
     */
    public function getContextualName()
    {
        return $this->contextualName;
    }

    /**
     * @param string $countryCode
     * @throws InvalidArgumentException
     */
    public function setCountryCode($countryCode)
    {
        if (!is_string($countryCode)) {
            throw new InvalidArgumentException('Country code must be a string');
        }
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return [
            'id'             => $this->getId(),
            'name'           => $this->getName(),
            'contextualName' => $this->getContextualName(),
            'countryCode'    => $this->getCountryCode(),
        ];
    }
}
