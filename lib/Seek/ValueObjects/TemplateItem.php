<?php namespace Seek\ValueObjects;

use Seek\Exceptions\InvalidArgumentException;

/**
 * Video value object
 */
final class TemplateItem implements ValueObjectInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $name
     * @param string $value
     * @throws InvalidArgumentException
     */
    public function __construct($name, $value)
    {
        $this->setName($name);
        $this->setValue($value);
    }

    /**
     * @param string $name
     * @throws InvalidArgumentException
     */
    private function setName($name)
    {
        if (!is_string($name)) {
            throw new InvalidArgumentException('Contact name must be a string');
        }

        if (!$name) {
            throw new InvalidArgumentException('Contact name cannot be empty');
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
     * @param string $value
     * @throws InvalidArgumentException
     */
    private function setValue($value)
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('Template item value must be a string');
        }

        if (!$value) {
            throw new InvalidArgumentException('Template item value cannot be empty');
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
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
