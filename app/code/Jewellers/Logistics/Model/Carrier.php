<?php
namespace Jewellers\Logistics\Model;

use Magento\Framework\Model\AbstractModel;

class Carrier extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Jewellers\Logistics\Model\ResourceModel\Carrier');
    }

    public function getIdFieldName()
    {
        return 'id';  // Ensure the correct primary key column is set
    }
}

