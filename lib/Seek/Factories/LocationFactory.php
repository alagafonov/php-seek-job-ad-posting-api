<?php namespace Seek\Factories;

use Seek\Entities\Location;

/**
 * Location factory
 */
class LocationFactory extends AbstractEntityFactory
{
    /**
     * @param array $data
     * @return Location[]
     */
    public static function createFromQueryResponse(array $data)
    {
        $result = [];
        foreach ($data as $record) {
            $result[] = self::createFromArray(
                [
                    'id' => $record['location']['id']['value'],
                    'name' => $record['location']['name'],
                    'contextualName' => $record['location']['contextualName'],
                    'countryCode' => $record['location']['countryCode'],
                ]
            );
        }
        return $result;
    }

    /**
     * @param array $data
     * @return Location
     * @throws \Seek\Exceptions\InvalidArgumentException
     */
    public static function createFromArray(array $data)
    {
        return new Location($data['id'], $data['name'], $data['contextualName'], $data['countryCode']);
    }
}
