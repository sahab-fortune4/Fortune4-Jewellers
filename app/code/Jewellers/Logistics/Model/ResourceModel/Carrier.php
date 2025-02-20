<?php
namespace Jewellers\Logistics\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Carrier extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('jewellers_logistics_carrier', 'entity_id');
    }
}