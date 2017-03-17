<?php namespace Seek\ValueObjects;

use Seek\Exceptions\InvalidArgumentException;

/**
 * Video value object
 */
final class Template implements ValueObjectInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var []TemplateItem
     */
    protected $items;

    /**
     * @param string $id
     * @param []TemplateItem $items
     * @throws InvalidArgumentException
     */
    public function __construct($id, array $items = [])
    {
        $this->setId($id);
        if (!empty($items)) {
            foreach ($items as $item) {
                $this->addTemplateItem($item);
            }
        }
    }

    /**
     * @param int $id
     * @throws InvalidArgumentException
     */
    private function setId($id)
    {
        if (!is_int($id)) {
            throw new InvalidArgumentException('Template id must be an integer value');
        }
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param TemplateItem $item
     * @throws InvalidArgumentException
     */
    public function addTemplateItem(TemplateItem $item)
    {
        $this->items[] = $item;
    }

    /**
     * @return string
     */
    public function getTemplateItems()
    {
        return $this->items;
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
