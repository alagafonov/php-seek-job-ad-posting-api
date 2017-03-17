<?php namespace Seek\Entities;

use Seek\Exceptions\InvalidArgumentException;

/**
 * Entity abstract class
 */
abstract class Entity
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @param string $id
     * @throws InvalidArgumentException
     */
    public function __construct($id)
    {
        $this->setId($id);
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

        if (!$id) {
            throw new InvalidArgumentException('Id cannot be empty');
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
     * @return array
     */
    public function getArray()
    {
        return [
            'creationId' => $this->id,
        ];
    }
}
