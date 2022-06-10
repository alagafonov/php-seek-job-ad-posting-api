<?php namespace Seek\Entities;

use Seek\Enums\DescriptionId;
use Seek\Exceptions\InvalidArgumentException;

/**
 * Position formatted description
 */
class PositionFormattedDescriptionInput extends Entity
{
    /**
     * Position description
     *
     * @var string
     */
    protected $content;

    /**
     * Position description type
     *
     * @var string
     */
    protected $descriptionId;

    /**
     * @param string $content
     * @param string $descriptionId
     * @throws InvalidArgumentException
     */
    public function __construct(
        $content,
        $descriptionId = DescriptionId::ADVERTISEMENT_DETAILS
    ) {
        $this->setContent($content);
        $this->setDescriptionId($descriptionId);
    }

    /**
     * @param string $content
     * @throws InvalidArgumentException
     */
    public function setContent($content)
    {
        if (empty($content)) {
            throw new InvalidArgumentException('Content cannot be empty');
        }
        if (!is_string($content)) {
            throw new InvalidArgumentException('Content must be a string');
        }
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $descriptionId
     * @throws InvalidArgumentException
     */
    public function setDescriptionId($descriptionId)
    {
        if (empty($descriptionId)) {
            throw new InvalidArgumentException('Description Id cannot be empty');
        }
        if (!is_string($descriptionId)) {
            throw new InvalidArgumentException('Description Id must be a string');
        }
        $this->descriptionId = $descriptionId;
    }

    /**
     * @return string
     */
    public function getDescriptionId()
    {
        return $this->descriptionId;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return [
            'content'       => $this->getContent(),
            'descriptionId' => $this->getDescriptionId(),
        ];
    }
}
