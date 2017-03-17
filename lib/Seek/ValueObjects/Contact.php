<?php namespace Seek\ValueObjects;

use Seek\Exceptions\InvalidArgumentException;

/**
 * Phone value object
 */
final class Contact implements ValueObjectInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $email;

    /**
     * @param string $name
     * @param string|null $phone
     * @param string|null $email
     * @throws InvalidArgumentException
     */
    public function __construct($name, $phone = null, $email = null)
    {
        $this->setName($name);
        $this->setPhone($phone);
        $this->setEmail($email);
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
     * @param string $phone
     * @throws InvalidArgumentException
     */
    private function setPhone($phone)
    {
        if ($phone !== null && !is_string($phone)) {
            throw new InvalidArgumentException('Contact phone must be a string');
        }

        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $email
     * @throws InvalidArgumentException
     */
    private function setEmail($email)
    {
        if ($email !== null && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Contact email format is invalid');
        }
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
