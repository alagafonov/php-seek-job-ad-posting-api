<?php namespace Seek\Api;

/**
 * GraphQL direct query
 */
class Query extends ApiAbstract
{
    /**
     * @param string $query
     * @param array $parameters
     * @return mixed
     */
    public function run($query, array $parameters = [])
    {
        return $this->query($query, $parameters)['data'];
    }
}
