<?php
namespace Jewellers\FormSubmission\Model;

use Magento\Framework\Model\AbstractModel;

class Submission extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Jewellers\FormSubmission\Model\ResourceModel\Submission');
    }

    public function getIdFieldName()
    {
        return 'entity_id';  // Ensure the correct primary key column is set
    }
}

