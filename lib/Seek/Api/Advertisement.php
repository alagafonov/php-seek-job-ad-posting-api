<?php namespace Seek\Api;

/**
 * Listing end point
 */
class Advertisement extends ApiAbstract
{
    /**
     * @param int $listingId
     * @return ListingEntity
     */
    public function retrieve($listingId)
    {
        //return ListingFactory::createListingFromArray(
        //    ListingFactory::transformArray($this->get('/Selling/Listings/' . $listingId . '.json'))
        //);
    }

    /**
     * @param ListingEntity $listing
     * @return mixed
     */
    public function create()
    {
        echo 'dddd';
        //return $this->post('/Selling.json', $listing->getArray());
    }
}
