<?php namespace Seek\ValueObjects;

use Seek\Enums\SalaryType;
use Seek\Exceptions\InvalidArgumentException;

/**
 * Salary value object
 */
final class Salary implements ValueObjectInterface
{
    /**
     * @var SalaryType
     */
    private $type;

    /**
     * Minimum salary of the salary range applicable to the job advertisement.
     *
     * @var float
     */
    private $minimum;

    /**
     * Maximum salary of the salary range applicable to the job advertisement.
     *
     * @var float
     */
    private $maximum;

    /**
     * Optional string used to specify salary information for display to candidates [limited to 50 characters].
     * No formatting tags are allowed e.g. < b >Bold< /b >, < br >, etc.
     *
     * @var string
     */
    private $details;

    /**
     * Salary currency
     *
     * @var string
     */
    private $currency;

    /**
     * @param SalaryType $type
     * @param float $minimum
     * @param float $maximum
     * @param string $details
     * @param string $currency
     * @throws InvalidArgumentException
     */
    public function __construct(SalaryType $type, $minimum, $maximum, $details = '', $currency = 'AUD')
    {
        $this->setType($type);
        $this->setMinimum($minimum);
        $this->setMaximum($maximum);
        $this->setDetails($details);
        $this->setCurrency($currency);
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
     * @param float $minimum
     * @throws InvalidArgumentException
     */
    private function setMinimum($minimum)
    {
        if (!is_float($minimum) && !is_int($minimum)) {
            throw new InvalidArgumentException('Salary minimum amount must be a numeric value');
        }

        if (!$minimum) {
            throw new InvalidArgumentException('Salary minimum amount must be greater than 0');
        }

        $this->minimum = $minimum;
    }

    /**
     * @return float
     */
    public function getMinimum()
    {
        return $this->minimum;
    }

    /**
     * @param float $maximum
     * @throws InvalidArgumentException
     */
    private function setMaximum($maximum)
    {
        if (!is_float($maximum) && !is_int($maximum)) {
            throw new InvalidArgumentException('Salary maximum amount must be a numeric value');
        }

        $this->maximum = $maximum;
    }

    /**
     * @return float
     */
    public function getMaximum()
    {
        return $this->maximum;
    }

    /**
     * @param string $details
     * @throws InvalidArgumentException
     */
    private function setDetails($details)
    {
        if ($details !== null && !is_string($details)) {
            throw new InvalidArgumentException('Salary description must be a string');
        }

        if (strlen($details) > 50) {
            throw new InvalidArgumentException('Salary description must be no more than 50 characters long');
        }
        $this->details = $details;
    }

    /**
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param string $currency
     * @throws InvalidArgumentException
     */
    private function setCurrency($currency)
    {
        if (!is_string($currency)) {
            throw new InvalidArgumentException('Currency must be a string');
        }

        if (!in_array($currency, ['AUD', 'NZD', 'USD'])) {
            throw new InvalidArgumentException('Currency "'.$currency.'" is invalid.');
        }
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        $type = $this->getType()->getValue();
        return [
            'basisCode'    => $type,
            'descriptions' => [$this->getDetails()],
            'ranges'       => [
                'intervalCode'  => $type == SalaryType::HOURLY_RATE ? 'Hour' : 'Year',
                'minimumAmount' => ['currency' => $this->getCurrency(), 'value' => $this->getMinimum()],
                'maximumAmount' => ['currency' => $this->getCurrency(), 'value' => $this->getMaximum()],
            ],
        ];
    }
}
