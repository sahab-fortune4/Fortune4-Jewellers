<?php
namespace Jewellers\FormSubmission\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Submission extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('jewellers_form_submission', 'entity_id');
    }
}
