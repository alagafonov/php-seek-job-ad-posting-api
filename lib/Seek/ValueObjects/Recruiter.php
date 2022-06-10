<?php namespace Seek\ValueObjects;

use Seek\Enums\ContactRoleCode;
use Seek\Exceptions\InvalidArgumentException;

/**
 * Recruiter value object
 */
final class Recruiter implements ValueObjectInterface
{
    /**
     * The first name and surname separated by a space of recruiter who is responsible for the job ad and handling
     * the recruitment of the position.
     *
     * @var string
     */
    private $fullName;

    /**
     * The email address of recruiter who is responsible for the job ad and handling the recruitment of the position.
     *
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * The role of the person.
     *
     * @var ContactRoleCode
     */
    private $roleCode;

    /**
     * @param string $fullName
     * @param string $email
     * @param string $phone
     * @param ContactRoleCode $roleCode
     * @throws InvalidArgumentException
     */
    public function __construct($fullName, $email, $phone, ContactRoleCode $roleCode = null)
    {
        $this->setFullName($fullName);
        $this->setEmail($email);
        $this->setPhone($phone);
        if ($roleCode === null) {
            $roleCode = ContactRoleCode::get('Recruiter');
        }
        $this->setRoleCode($roleCode);
    }

    /**
     * @param string $fullName
     * @throws InvalidArgumentException
     */
    private function setFullName($fullName)
    {
        if (!is_string($fullName)) {
            throw new InvalidArgumentException('Recruiter full name must be a string');
        }

        if (!$fullName) {
            throw new InvalidArgumentException('Recruiter full name cannot be empty');
        }
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $email
     * @throws InvalidArgumentException
     */
    private function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Recruiter email format is invalid');
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
     * @param string $phone
     * @throws InvalidArgumentException
     */
    private function setPhone($phone)
    {
        if (!is_string($phone)) {
            throw new InvalidArgumentException('Recruiter phone must be a string');
        }
        if (!$phone) {
            throw new InvalidArgumentException('Recruiter phone cannot be empty');
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
     * @param ContactRoleCode $roleCode
     */
    private function setRoleCode(ContactRoleCode $roleCode)
    {
        $this->roleCode = $roleCode;
    }

    /**
     * @return ContactRoleCode
     */
    public function getRoleCode()
    {
        return $this->roleCode;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return [
            'name'          => ['formattedName' => $this->getFullName()],
            'roleCode'      => $this->getRoleCode()->getValue(),
            'communication' => [
                'email' => [['address' => $this->getEmail()]],
                'phone' => [['formattedNumber' => $this->getPhone()]],
            ],
        ];
    }
}
