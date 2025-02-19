<?php
namespace Jewellers\Logistics\Model\ResourceModel\Carrier;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected function _construct()
    {
        $this->_init('Jewellers\Logistics\Model\Carrier', 'Jewellers\Logistics\Model\ResourceModel\Carrier');
    }
}
