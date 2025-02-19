<?php
namespace Jewellers\Logistics\Model\ResourceModel\Carrier\Grid;

use Jewellers\Logistics\Model\ResourceModel\Carrier\Collection as CarrierCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\Search\AggregationInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class Collection extends CarrierCollection implements SearchResultInterface
{
    /**
     * @var AggregationInterface
     */
    protected $aggregations;

    public function getAggregations()
    {
        return $this->aggregations;
    }
    
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    public function getSearchCriteria()
    {
        return null;
    }
    
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }
    
    public function getTotalCount()
    {
        return $this->getSize();
    }
    
    public function setTotalCount($totalCount)
    {
        return $this;
    }
    
    public function setItems(array $items = null)
    {
        return $this;
    }
}


