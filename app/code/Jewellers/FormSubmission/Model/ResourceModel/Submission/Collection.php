<?php
namespace Jewellers\FormSubmission\Model\ResourceModel\Submission;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected function _construct()
    {
        $this->_init('Jewellers\FormSubmission\Model\Submission', 'Jewellers\FormSubmission\Model\ResourceModel\Submission');
    }
}
