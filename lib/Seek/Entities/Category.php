<?php namespace Seek\Entities;

use Seek\Exceptions\InvalidArgumentException;

/**
 * Category entity
 */
class Category extends Entity
{
    /**
     * Category id
     *
     * @var string
     */
    protected $id;

    /**
     * Category name
     *
     * @var string
     */
    protected $name;

    /**
     * @param string $id
     * @param string $name
     * @throws InvalidArgumentException
     */
    public function __construct(
        $id,
        $name
    ) {
        $this->setId($id);
        $this->setName($name);
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
     * @return array
     */
    public function getArray()
    {
        return [
            'id'   => $this->getId(),
            'name' => $this->getName(),
        ];
    }
}
